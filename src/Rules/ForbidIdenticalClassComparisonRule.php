<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Rules;

use LogicException;
use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\IdentifierRuleError;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\BooleanType;
use PHPStan\Type\CallableType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\ObjectWithoutClassType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;
use PHPStan\Type\VerbosityLevel;

/**
 * Rewrite of ShipMonk\PHPStan\Rule\ForbidIdenticalClassComparisonRule
 * to replace their blacklist with an allow list
 * @implements Rule<BinaryOp>
 */
class ForbidIdenticalClassComparisonRule implements Rule
{
    private const MESSAGE = 'Using %s with %s and %s is denied';

    /**
     * These types support inheritance
     * @var array<int, Type>
     */
    private array $allowedTypes;

    /**
     * These types don't support inheritance
     * @var array<int, Type>
     */
    private array $allowedExactTypes;

    /**
     * @param array<int, class-string<object>> $allowList
     */
    public function __construct(ReflectionProvider $reflectionProvider, array $allowList)
    {
        $this->allowedTypes = [];
        foreach ($allowList as $className) {
            if (!$reflectionProvider->hasClass($className)) {
                throw new LogicException(sprintf('Class %s does not exist.', $className));
            }
            $this->allowedTypes[] = new ObjectType($className);
        }
        // Scalars (including nullable)
        $this->allowedTypes[] = new UnionType([new BooleanType(), new NullType()]);
        $this->allowedTypes[] = new UnionType([new FloatType(), new NullType()]);
        $this->allowedTypes[] = new UnionType([new IntegerType(), new NullType()]);
        $this->allowedTypes[] = new UnionType([new StringType(), new NullType()]);

        $this->allowedExactTypes = [];
        // "maybe" accepted by any (allowed) class
        $this->allowedExactTypes[] = new MixedType(); // mixed is "maybe"
        $this->allowedExactTypes[] = new ObjectWithoutClassType(); // object is "maybe"
        // any non-final class descendant can have __invoke method causing it to be "maybe"
        $this->allowedExactTypes[] = new CallableType();
    }

    public function getNodeType(): string
    {
        return BinaryOp::class;
    }

    /**
     * @param BinaryOp $node
     * @return list<IdentifierRuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof Identical && !$node instanceof NotIdentical) {
            return [];
        }

        $nodeType = $scope->getType($node);
        if ($nodeType->isTrue()->yes() || $nodeType->isFalse()->yes()) {
            return []; // always-true or always-false, already reported by native PHPStan (like $a === $a)
        }

        $rightType = $scope->getType($node->right);
        $leftType = $scope->getType($node->left);

        if ($this->isAccepted($rightType, $leftType) || $this->isAccepted($leftType, $rightType)) {
            return [];
        }

        return [
            RuleErrorBuilder::message(sprintf(
                self::MESSAGE,
                $node->getOperatorSigil(),
                $leftType->describe(VerbosityLevel::typeOnly()),
                $rightType->describe(VerbosityLevel::typeOnly()),
            ))
                ->identifier('assoconnect.identicalClassComparison')
                ->build(),
        ];
    }

    private function isAccepted(Type $firstArm, Type $otherArm): bool
    {
        foreach ($this->allowedExactTypes as $allowedExactType) {
            if ($allowedExactType->equals($firstArm)) {
                return true;
            }
        }

        // About isSuperTypeOf()
        // https://phpstan.org/developing-extensions/type-system#querying-a-specific-type
        foreach ($this->allowedTypes as $allowedType) {
            if ($allowedType->isSuperTypeOf($firstArm)->yes()) {
                return true;
            }
        }


        $arrays = $firstArm->getArrays();
        if ([] !== $arrays) {
            $firstArray = $arrays[0];
            // Empty array
            if ($firstArray->isIterableAtLeastOnce()->no()) {
                return true;
            }
            return $this->isAccepted($firstArray->getIterableValueType(), $otherArm);
        }

        if ($this->typeIsEnumOrNull($firstArm) && $this->typeIsEnumOrNull($otherArm)) {
            // Both arms are enum
            return true;
        }

        return false;
    }

    private function typeIsEnumOrNull(Type $type): bool
    {
        if ($type->isEnum()->yes()) {
            return true;
        }

        if ($type instanceof UnionType) {
            [$firstType, $secondType] = $type->getTypes();
            return ($firstType->isEnum()->yes() && $secondType->isNull()->yes())
                || ($secondType->isEnum()->yes() && $firstType->isNull()->yes())
            ;
        }

        return false;
    }
}
