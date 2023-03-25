<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Tests\Rules;

use AssoConnect\PHPStanRules\Rules\EnforceHttpsLinksInStringScalarRule;
use AssoConnect\PHPStanRules\Rules\EnforceHttpsLinksRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/** @extends RuleTestCase<EnforceHttpsLinksInStringScalarRule> */
class EnforceHttpsLinksInStringScalarRuleTest extends RuleTestCase
{
    public function getRule(): Rule
    {
        return new EnforceHttpsLinksInStringScalarRule();
    }

    public function testTruePositivesAreDetected(): void
    {
        $this->analyse([__DIR__ . '/EnforceHttpsLinksRule.file.php'], [
            [
                EnforceHttpsLinksRule::MESSAGE,
                6,
            ],
        ]);
    }
}
