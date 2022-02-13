<?php

declare(strict_types=1);

function formatMoney(string $value): float
{
    return floatval(
        str_replace(
            ',',
            '.',
            str_replace('.', '', $value)
        )
    );
}
