<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Tests\Rules;

use AssoConnect\PHPStanRules\Rules\ForbidIdenticalClassComparisonRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/** @extends RuleTestCase<ForbidIdenticalClassComparisonRule> */
class ForbidIdenticalClassComparisonRuleTest extends RuleTestCase
{
    public function getRule(): Rule
    {
        return new ForbidIdenticalClassComparisonRule(
            $this->createReflectionProvider(),
            [\DateTimeImmutable::class]
        );
    }

    public function testTruePositivesAreDetected(): void
    {
        $this->analyse([__DIR__ . '/ForbidIdenticalClassComparisonRule.file.php'], [
            [
                'Using === with DateTime and DateTime is denied',
                5,
            ],
            [
                'Using === with array<int, DateTime> and array<int, DateTime> is denied',
                6,
            ],
            [
                'Using === with string|false and string|false is denied',
                12,
            ],
            [
                'Using === with DateTime|string and DateTime|string is denied',
                18,
            ],
            [
                'Using === with int|string and int|string is denied',
                24,
            ],
        ]);
    }
}
