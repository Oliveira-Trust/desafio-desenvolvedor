<?php

namespace App\Actions;

/**
 * @method mixed handle()
 */
abstract class Action
{
    public static function make(): self
    {
        return app(static::class);
    }

    public static function run(...$args): mixed
    {
        return static::make()->handle(...$args);
    }
}
