<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('csv_file', function ($attribute, $value, $parameters, $validator) {
            if (!$value->isValid()) {
                return false;
            }
            
            $extension = strtolower($value->getClientOriginalExtension());
            $mimeType = $value->getMimeType();
            
            return ($extension === 'csv' || $mimeType === 'text/csv' || $mimeType === 'text/plain');
        });
    }
}
