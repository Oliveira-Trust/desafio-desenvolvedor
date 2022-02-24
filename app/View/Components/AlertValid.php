<?php

namespace App\View\Components;

use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Boolean;

class AlertValid extends Component
{
    /**
     * The alert data.
     *
     * @var any
     */
    public $data;

    /**
     * The alert type.
     *
     * @var string
     */
    public $type;

    /**
     * The alert show.
     *
     * @var Boolean
     */
    public $show = true;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (count($this->data)) {
            $this->show = false;
        } else {
            $this->show = false;
        }

        return view('components.alert-valid');
    }
}
