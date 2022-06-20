<?php

function getTimezone()
{
    return 'America/Sao_Paulo';
}

function toDate($data, bool $time = true, string $date_format = '', string $time_format = 'H:i:s', $setTimeZone = true)
{
    if ( ! $data) {
        return null;
    }

    if ( ! $date_format) {
        $date_format = 'd/m/Y';
    }

    if ($time) {
        $date_format .= ' ' . $time_format;
    }

    if ($setTimeZone) {
        return $data->timezone(getTimezone())->format($date_format);
    }

    return $data->format($date_format);
}
