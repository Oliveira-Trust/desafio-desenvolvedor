<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public string $formActionRoute;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($formActionRoute)
    {
        $this->formActionRoute = $formActionRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.auth-layout');
    }
}
