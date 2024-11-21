<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/** @implements Rule<New_> */
class DateTimeMustNotBeUsedRule implements Rule
{
    public const MESSAGE = 'Don\'t use DateTime: use "DateTimeImmutable" instead';

    public const TIP =
        'Learn more at https://www.notion.so/assoconnect/Use-DateTimeImmutable-c6ea0b48d83d41f98d8c722c14b890ba';

    public function getNodeType(): string
    {
        return New_::class;
    }

    /** @param New_ $node */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->class instanceof FullyQualified) {
            return [];
        }

        $classString = $node->class->toCodeString();

        if ('\DateTime' === $classString) {
            return [RuleErrorBuilder::message(self::MESSAGE)->tip(self::TIP)->build()];
        }
        return [];
    }
}
