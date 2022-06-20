<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Oliveiratrust\Models\Quotation\Quotation;
use Oliveiratrust\Models\User\User;
use Oliveiratrust\Quotation\QuotationPolicy;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Quotation::class => QuotationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
