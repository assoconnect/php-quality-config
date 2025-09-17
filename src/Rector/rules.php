<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\Config\RectorConfig;
use Rector\Strict\Rector\BooleanNot\BooleanInBooleanNotRuleFixerRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        // Coding style
        StaticArrowFunctionRector::class,
        StaticClosureRector::class,
        // Code Quality
        LogicalToBooleanRector::class,
        // Strict
        BooleanInBooleanNotRuleFixerRector::class,
        // Type Declaration
        ReturnTypeFromStrictTypedCallRector::class,
    ]);
};
