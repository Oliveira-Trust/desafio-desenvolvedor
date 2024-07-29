<?php

function sanitizaNumbers($number): array|string|null
{
    if ($number) {
        return  preg_replace("/[^0-9]/", "", $number) / 100;
    }
    return null;
}
