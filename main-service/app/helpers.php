<?php

declare(strict_types=1);

function convertStringToFloat(string $value) : float
{
    $string_number = str_replace(['.', ','], ['', '.'], $value);
    return (float)$string_number;
}
