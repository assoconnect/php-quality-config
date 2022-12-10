<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Rules;

use PhpParser\Node;
use PhpParser\Node\Scalar\String_;
use PHPStan\Analyser\Scope;

/** @extends EnforceHttpsLinksRule<String_>  */
class EnforceHttpsLinksInStringScalarRule extends EnforceHttpsLinksRule
{
    public function getNodeType(): string
    {
        return String_::class;
    }

    /** @param String_ $node */
    public function processNode(Node $node, Scope $scope): array
    {
        return $this->checkStringValue($node->value);
    }
}
