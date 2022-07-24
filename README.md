# PHPStan rules used at AssoConnect

[![Build Status](https://github.com/assoconnect/phpstan-rules/actions/workflows/build.yml/badge.svg)](https://github.com/assoconnect/phpstan-rules/actions/workflows/build.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=assoconnect_phpstan-rules&metric=alert_status)](https://sonarcloud.io/dashboard?id=assoconnect_phpstan-rules)

## Installation

```
composer require --dev assoconnect/phpstan-rules
```

## Including in this package
* `EnforceHttpsLinksRule` to ban insecure links containing `http:` in string scalars and PHPDoc blocks

## From other packages

These elements are also imported:
* Uses `phpstan/phpstan-phpunit`
* Uses `phpstan/phpstan-strict-rules`
* Uses `phpstan/phpstan-webmozart-assert`
* Uses `roave/no-floaters`