<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeaderLink extends Component
{
    public string $route;
    public string $page;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $page)
    {
        $this->route = $route;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-link');
    }
}
