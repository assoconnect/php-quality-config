# Quality config used at AssoConnect

[![Build Status](https://github.com/assoconnect/php-quality-config/actions/workflows/build.yml/badge.svg)](https://github.com/assoconnect/php-quality-config/actions/workflows/build.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=assoconnect_php-quality-config&metric=alert_status)](https://sonarcloud.io/dashboard?id=assoconnect_php-quality-config)

## Installation

```
composer require --dev assoconnect/php-quality-config
```

In rector, you can use the ruleset:

```php
return RectorConfig::configure()
    ->withSets([
        __DIR__ . '/vendor/assoconnect/php-quality-config/src/Rector/rules.php',
    ])
```

## PHPStan

### Including in this package
* `EnforceHttpsLinksRule` to ban insecure links containing `http:` in string scalars and PHPDoc blocks
* `ForbidIdenticalClassComparisonRule` to ban strict comparison of objects
* `DateTimeMustNotBeUsedRule` to ban the usage of `DateTime` and enforce the use of `DateTimeImmutable` for safer and more predictable date handling

### From other packages
* `phpstan/phpstan-phpunit`
* `phpstan/phpstan-strict-rules`
* `phpstan/phpstan-webmozart-assert`
* `roave/no-floaters`
* `shipmonk/phpstan-rules`
* `thecodingmachine/phpstan-strict-rules`

## PHPCS / Code Style

### Including in this package
* `PSR-12` coding standard

### From other packages
* `SlevomatCodingStandard.Namespaces.UnusedUses`
