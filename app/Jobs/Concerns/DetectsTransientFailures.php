<?php

namespace App\Jobs\Concerns;

use Throwable;

trait DetectsTransientFailures
{
    protected function shouldRetryAfterFailure(Throwable $exception): bool
    {
        $message = strtolower($exception->getMessage());

        foreach ($this->transientFailurePatterns() as $pattern) {
            if (str_contains($message, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<int, string>
     */
    protected function transientFailurePatterns(): array
    {
        return config('ingestion.jobs.transient_failure_patterns', [
            'deadlock',
            'lock wait timeout',
            'server has gone away',
            'connection refused',
            'timed out',
        ]);
    }
}
