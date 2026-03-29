<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Tests\Rules;

use AssoConnect\PHPStanRules\Rules\DateTimeMustNotBeUsedRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\Group;

/** @extends RuleTestCase<DateTimeMustNotBeUsedRule> */
class DateTimeMustNotBeUsedRuleTest extends RuleTestCase
{
    public function getRule(): Rule
    {
        return new DateTimeMustNotBeUsedRule();
    }

    #[Group('unit')]
    public function testTruePositivesAreDetected(): void
    {
        $this->analyse([__DIR__ . '/DateTimeMustNotBeUsedRule.file.php'], [
            [
                DateTimeMustNotBeUsedRule::MESSAGE,
                5,
                DateTimeMustNotBeUsedRule::TIP,
            ],
            [
                DateTimeMustNotBeUsedRule::MESSAGE,
                6,
                DateTimeMustNotBeUsedRule::TIP,
            ],
        ]);
    }
}
