<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/** @extends EnforceHttpsLinksRule<Node>  */
class EnforceHttpsLinksInPhpDocRule extends EnforceHttpsLinksRule
{
    public function getNodeType(): string
    {
        return Node::class;
    }

    /** @param Node $node */
    public function processNode(Node $node, Scope $scope): array
    {
        $phpdoc = $node->getDocComment();
        if (null === $phpdoc) {
            return [];
        }

        return $this->checkStringValue($phpdoc->getText());
    }
}
