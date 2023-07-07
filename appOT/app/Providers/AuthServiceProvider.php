<?php

namespace App\Providers;

//use App\Models\PaymentMethod;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
     //   PaymentMethod::class => PaymentMethodPolicy::class,
    ];

    public function boot(): void
    {
   //     $this->registerPolicies();
    }
}
