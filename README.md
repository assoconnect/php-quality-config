# Quality config used at AssoConnect

[![Build Status](https://github.com/assoconnect/php-quality-config/actions/workflows/build.yml/badge.svg)](https://github.com/assoconnect/php-quality-config/actions/workflows/build.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=assoconnect_php-quality-config&metric=alert_status)](https://sonarcloud.io/dashboard?id=assoconnect_php-quality-config)

## Installation

```
composer require --dev assoconnect/php-quality-config
```

## PHPStan

### Including in this package
* `EnforceHttpsLinksRule` to ban insecure links containing `http:` in string scalars and PHPDoc blocks

### From other packages
* `phpstan/phpstan-phpunit`
* `phpstan/phpstan-strict-rules`
* `phpstan/phpstan-webmozart-assert`
* `roave/no-floaters`

## PHPCS / Code Style

### Including in this package
* `PSR-12` coding standard

### From other packages
* `SlevomatCodingStandard.Namespaces.UnusedUses`
