<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('NavBar', function ($menu) {
            $menu->add('<span>Dashboard</span>', ['route' => 'home'])
                ->prepend('<i class="fas fa-home mr-2"></i>');

            $menu->add('<span>'. __('Orders') .'</span>', ['route' => 'order.index'])
                ->active('order/*')
                ->prepend('<i class="fas fa-file mr-2"></i>');

            $menu->add('<span>'. __('Products') .'</span>', ['route' => 'product.index'])
                ->active('product/*')
                ->prepend('<i class="fas fa-shopping-cart mr-2"></i>');

            $menu->add("<span>".__('Customers')."</span>", ['route' => 'customer.index'])
                ->active('customer/*')
                ->prepend('<i class="fas fa-user-friends mr-2"></i>');
        });

        return $next($request);
    }
}
