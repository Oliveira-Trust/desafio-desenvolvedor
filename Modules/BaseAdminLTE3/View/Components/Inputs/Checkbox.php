<?php

namespace Modules\BaseAdminLTE3\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class Checkbox extends Component {


    public $name;
    /**
     * @var null
     */
    public $field;
    /**
     * @var null
     */
    public $label;
    /**
     * @var null
     */
    public $value;
    /**
     * @var false
     */
    public bool $required;
    /**
     * @var false
     */
    public bool $disabled;
    /**
     * @var null
     */
    public $divClass;
    /**
     * @var null
     */
    public $labelClass;
    /**
     * @var null
     */
    public $inputClass;

    public function __construct($name, $field = null, $label = null, $value = null, $required = false, $disabled = false, $inputClass = null, $divClass = null, $labelClass = null) {

        $this->name       = $name;
        $this->field      = $field;
        $this->label      = $label;
        $this->value      = $value;
        $this->required   = $required;
        $this->disabled   = $disabled;
        $this->labelClass = $labelClass;

        $this->field = $field ?? str_replace(['[', ']'], ['.', ''], $name);
        $this->setInputClass($inputClass);
        $this->setDivClass($divClass);
    }

    public function setInputClass($inputClass): void {
        $collect = collect();
        // $collect->push('form-control');

        if ($error = bs4_error($this->name, 'is-invalid')) {
            $collect->push($error);
        }

        if ($inputClass) {
            $collect->push($inputClass);
        }

        $this->inputClass = $collect->implode(' ');
    }

    public function setDivClass($divClass): void {
        $collect = collect();

        if ($divClass) {
            $collect->push($divClass);
        } else {
            $collect->push('col-sm-8 offset-sm-4 align-self-center');//default if not custom
        }

        $this->divClass = $collect->implode(' ');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render() {
        return view('baseadminlte3::components.inputs.checkbox.checkbox-component');
    }
}
