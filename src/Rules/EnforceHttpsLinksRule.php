<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Rules;

use PhpParser\Node;
use PHPStan\Rules\IdentifierRuleError;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @phpstan-template TNodeType of Node
 * @implements Rule<TNodeType>
 */
abstract class EnforceHttpsLinksRule implements Rule
{
    public const MESSAGE = 'The string contains an insecure link';

    /** @return list<IdentifierRuleError> errors */
    protected function checkStringValue(string $value): array
    {
        if (false !== strpos($value, 'http' . ':')) {
            return [
                RuleErrorBuilder::message(self::MESSAGE)
                    ->identifier('assoconnect.insecureLink')
                    ->build(),
            ];
        }

        return[];
    }
}
