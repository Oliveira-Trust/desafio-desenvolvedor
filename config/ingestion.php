<?php

$parseBackoff = static function (string $key, string $default): array {
    $values = explode(',', (string) env($key, $default));

    return array_values(array_filter(
        array_map(static function (string $value): ?int {
            $normalized = trim($value);

            if ($normalized === '' || ! is_numeric($normalized)) {
                return null;
            }

            return (int) $normalized;
        }, $values),
        static fn (?int $value): bool => $value !== null
    ));
};

return [
    'jobs' => [
        'transient_failure_patterns' => [
            'deadlock',
            'lock wait timeout',
            'server has gone away',
            'connection refused',
            'timed out',
            'temporarily unavailable',
            'temporary failure',
            'try again',
        ],
        'upload' => [
            'tries' => (int) env('INGESTION_UPLOAD_TRIES', 3),
            'timeout' => (int) env('INGESTION_UPLOAD_TIMEOUT', 300),
            'backoff' => $parseBackoff('INGESTION_UPLOAD_BACKOFF', '10,30,60'),
        ],
        'chunk' => [
            'tries' => (int) env('INGESTION_CHUNK_TRIES', 3),
            'timeout' => (int) env('INGESTION_CHUNK_TIMEOUT', 300),
            'backoff' => $parseBackoff('INGESTION_CHUNK_BACKOFF', '5,15,30,60'),
        ],
    ],
];
