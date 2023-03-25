<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Tests\Rules;

use AssoConnect\PHPStanRules\Rules\EnforceHttpsLinksInPhpDocRule;
use AssoConnect\PHPStanRules\Rules\EnforceHttpsLinksRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/** @extends RuleTestCase<EnforceHttpsLinksInPhpDocRule> */
class EnforceHttpsLinksInPhpDocRuleTest extends RuleTestCase
{
    public function getRule(): Rule
    {
        return new EnforceHttpsLinksInPhpDocRule();
    }

    public function testTruePositivesAreDetected(): void
    {
        $this->analyse([__DIR__ . '/EnforceHttpsLinksRule.file.php'], array_fill(
            0,
            3,
            [
                EnforceHttpsLinksRule::MESSAGE,
                16,
            ],
        ));
    }
}
