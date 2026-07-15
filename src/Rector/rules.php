<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\LogicalAnd\LogicalToBooleanRector;
use Rector\Config\RectorConfig;
use Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector;
use Rector\PHPUnit\PHPUnit100\Rector\Class_\PublicDataProviderClassMethodRector;
use Rector\PHPUnit\PHPUnit100\Rector\Class_\StaticDataProviderClassMethodRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        // Code Quality
        LogicalToBooleanRector::class,
        // Type Declaration
        ReturnTypeFromStrictTypedCallRector::class,
        // Prepares PHPUnit 10
        StaticDataProviderClassMethodRector::class,
        PublicDataProviderClassMethodRector::class,
        // Prepares PHP 8.4
        ExplicitNullableParamTypeRector::class,
    ]);
};
