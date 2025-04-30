<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class InvalidateCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The pattern to use for cache invalidation.
     *
     * @var string
     */
    protected $pattern;

    /**
     * Create a new job instance.
     *
     * @param string $pattern
     * @return void
     */
    public function __construct(string $pattern = 'data_search_*')
    {
        $this->pattern = $pattern;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if (Cache::getStore() instanceof \Illuminate\Cache\RedisStore) {
                $redis = Cache::getStore()->getRedis();
                $keys = $redis->keys($this->pattern);
                
                $count = 0;
                foreach ($keys as $key) {
                    $redis->del($key);
                    $count++;
                }
                
                Log::info("Cache invalidation completed. {$count} keys cleared with pattern: {$this->pattern}");
            } else {
                Cache::flush();
                Log::info("Cache flushed completely as Redis store was not detected.");
            }
        } catch (\Exception $e) {
            Log::error("Error while invalidating cache: " . $e->getMessage());
        }
    }
} 