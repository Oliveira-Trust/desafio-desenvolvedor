<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropdownMenuLink extends Component
{
    public ?string $label;
    public ?string $route;
    public ?string $routeIs;
    public ?bool $separator;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $label = null, ?string $route = null, ?string $routeIs = null, ?bool $separator = false)
    {
        $this->label = $label;
        $this->route = $route;
        $this->routeIs = $routeIs;
        $this->separator = $separator;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdown-menu-link');
    }
}
