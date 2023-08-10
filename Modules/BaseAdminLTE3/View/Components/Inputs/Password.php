<?php

namespace Modules\BaseAdminLTE3\View\Components\Inputs;

use Illuminate\View\Component;

class Password extends Component {

    public $name;
    public $label;
    /**
     * @var null
     */
    public $placeholder;
    public bool $required;
    /**
     * @var null
     */
    public $fieldLength;


    /**
     * Text constructor.
     *
     * @param $name
     * @param $label
     * @param null $placeholder
     * @param bool $required
     * @param null $fieldLength
     */
    public function __construct($name, $label = null, $placeholder = null, $required = true, $fieldLength = null) {


        $this->name        = $name;
        $this->label       = $label;
        $this->placeholder = $placeholder;
        $this->required    = $required;

        $this->fieldLength = $fieldLength;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return view('baseadminlte3::components.inputs.password-component');
    }
}
