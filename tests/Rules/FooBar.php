<?php

declare(strict_types=1);

namespace AssoConnect\PHPStanRules\Tests\Rules;

enum FooBar: string
{
    case FOO = 'FOO';
    case BAR = 'BAR';
}

function enum(): FooBar
{
    return FooBar::BAR;
}
function enumNullable(): ?FooBar
{
    return random_int(0, 2) < 1 ? FooBar::BAR : null;
}
