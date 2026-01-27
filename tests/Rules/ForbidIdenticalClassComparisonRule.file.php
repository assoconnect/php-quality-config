<?php
// phpcs:ignoreFile
declare(strict_types=1);

use AssoConnect\PHPStanRules\Tests\Rules\FooBar;
use function AssoConnect\PHPStanRules\Tests\Rules\enum;
use function AssoConnect\PHPStanRules\Tests\Rules\enumNullable;

(new \DateTime()) === (new \DateTime());
[(new \DateTime())] === [(new \DateTime())];

/** @var string|false $falseOrString1 */
$falseOrString1 = 'a';
/** @var string|false $falseOrString2 */
$falseOrString2 = 'b';
$falseOrString1 === $falseOrString2;

/** @var string|\DateTime $stringOrDateTime1 */
$stringOrDateTime1 = 'a';
/** @var string|\DateTime $stringOrDateTime2 */
$stringOrDateTime2 = 'b';
$stringOrDateTime1 === $stringOrDateTime2;

/** @var int|string $intOrString1 */
$intOrString1 = 'a';
/** @var int|string $intOrString2 */
$intOrString2 = 'b';
$intOrString1 === $intOrString2;

// Allowed comparison
(new \DateTimeImmutable()) === (new \DateTimeImmutable());
(new \DateTime()) === (new \DateTimeImmutable());
[] === ['a'];
null === true;
'a' === 'b';
1 === 2;
0.1 === 0.2;

/** @var string|null $nullableString1 */
$nullableString1 = 'a';
/** @var string|null $nullableString2 */
$nullableString2 = 'b';
$nullableString1 === $nullableString2;

/** @var array<int, string> $arrayOfStrings1 */
$arrayOfStrings1 = ['a'];
/** @var array<int, string> $arrayOfStrings2 */
$arrayOfStrings2 = ['b'];
$arrayOfStrings1 === $arrayOfStrings2;


FooBar::FOO === enum();
FooBar::FOO === enumNullable();
FooBar::FOO === FooBar::FOO;
enum() === enum();
enum() === enumNullable();
