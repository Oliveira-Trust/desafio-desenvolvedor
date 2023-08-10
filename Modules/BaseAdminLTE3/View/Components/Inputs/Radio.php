<?php

namespace Modules\BaseAdminLTE3\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class Radio extends Component {

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
     * @var null
     */
    public $inputClass;
    public $disabled;
    public bool $horizontal;
    public bool $autofocus;
    public string $type;


    /**
     * Text constructor.
     *
     * @param $name
     * @param string $type
     * @param null $label
     * @param bool $horizontal
     * @param bool $autofocus
     * @param null $placeholder
     * @param bool $required
     * @param bool $disabled
     * @param null $fieldLength
     * @param null $inputClass
     */
    public function __construct($name, $type = 'text', $label = null, $horizontal = false, $autofocus = false, $placeholder = null, $required = true, $disabled = false, $fieldLength = null, $inputClass = null) {
        $this->name        = $name;
        $this->label       = $label;
        $this->placeholder = $placeholder;
        $this->required    = $required;

        $this->fieldLength = $fieldLength;

        $this->setInputClass($inputClass);

        $this->disabled   = $disabled;
        $this->horizontal = $horizontal;
        $this->autofocus  = $autofocus;
        $this->type       = $type;
    }

    public function setInputClass($inputClass) {
        $collect = collect();
        $collect->push('form-control');

        if ($error = bs4_error($this->name, 'is-invalid')) {
            $collect->push($error);
        }

        if ($inputClass) {
            $collect->push($inputClass);
        }

        $this->inputClass = $collect->implode(' ');
    }

    public function getClass() {
        $collect = collect();
        $collect->push('col-sm-3 col-form-label');
        if ($this->required) {
            $collect->push('required');
        }

        return $collect->implode(' ');
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render() {
        return view('baseadminlte3::components.inputs.radio.radio-component');
    }
}
