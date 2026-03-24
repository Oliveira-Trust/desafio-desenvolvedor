<?php

namespace Tests\Feature\Queue;

use App\Jobs\Concerns\DetectsTransientFailures;
use RuntimeException;
use Tests\TestCase;

class TransientFailureStrategyTest extends TestCase
{
    public function test_transient_failures_are_classified_for_retry(): void
    {
        $detector = new class
        {
            use DetectsTransientFailures;

            public function shouldRetry(\Throwable $exception): bool
            {
                return $this->shouldRetryAfterFailure($exception);
            }
        };

        $this->assertTrue($detector->shouldRetry(new RuntimeException('Deadlock found when trying to get lock')));
        $this->assertTrue($detector->shouldRetry(new RuntimeException('The service is temporarily unavailable')));
        $this->assertFalse($detector->shouldRetry(new RuntimeException('Arquivo do upload nao encontrado.')));
        $this->assertFalse($detector->shouldRetry(new RuntimeException('Formato de arquivo nao suportado: txt')));
    }
}
