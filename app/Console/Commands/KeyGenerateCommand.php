<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;

class KeyGenerateCommand extends Command
{
    use ConfirmableTrait;

    protected $signature = 'key:generate
                    {--show : Display the key instead of modifying files}
                    {--force : Force the operation to run when in production}';

    protected $description = 'Set the application key';

    public function handle()
    {
        $key = $this->generateRandomKey();

        if ($this->option('show')) {
            return $this->line('<comment>' . $key . '</comment>');
        }

        if (!$this->setKeyInEnvironmentFile($key)) {
            return;
        }

        $this->laravel['config']['app.key'] = $key;

        $this->info("Application key [$key] set successfully.");
    }

    protected function generateRandomKey()
    {
        return 'base64:' . base64_encode(random_bytes(
            $this->laravel['config']['app.cipher'] == 'AES-128-CBC' ? 16 : 32
        ));
    }

    protected function setKeyInEnvironmentFile($key)
    {
        $currentKey = $this->laravel['config']['app.key'] ?: env('APP_KEY');

        if (strlen($currentKey) !== 0 && (!$this->confirmToProceed())) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key);

        return true;
    }

    protected function writeNewEnvironmentFileWith($key)
    {
        file_put_contents($this->laravel->basePath('.env'), preg_replace(
            $this->keyReplacementPattern($key),
            'APP_KEY=' . $key,
            file_get_contents($this->laravel->basePath('.env'))
        ));
    }

    protected function keyReplacementPattern()
    {
        $currentKey = $this->laravel['config']['app.key'] ?: env('APP_KEY');
        $escaped    = preg_quote('=' . $currentKey, '/');

        return "/^APP_KEY{$escaped}/m";
    }
}
