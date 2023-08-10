<?php

namespace Modules\Conversion\View\Components;


use Illuminate\View\Component;
use Modules\Conversion\Models\Conversion as ConversionAlias;

class Conversion extends Component
{

    public ConversionAlias $conversion;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ConversionAlias $conversion)
    {
        $this->conversion = $conversion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('conversion::components.conversion');
    }
}
