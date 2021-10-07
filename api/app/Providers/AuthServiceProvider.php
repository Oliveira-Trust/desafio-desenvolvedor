<?php

namespace App\Providers;

use App\Models\Ususarios;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Dusterio\LumenPassport\LumenPassport;

class AuthServiceProvider extends ServiceProvider
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
    protected $policies = [
      //  'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        //LumenPassport::routes($this->app->router, ['prefix' => 'v1/oauth']);

        //LumenPassport::tokensExpireIn(Carbon::now()->addYears(50), 2);


        $this->app['auth']->viaRequest('api', function ($request) {
         // dd("test") // this works
         // dd(Auth::user());
         // dd($request->user());
         // dd(Auth::guard('api')->user());
    });
    }
}
