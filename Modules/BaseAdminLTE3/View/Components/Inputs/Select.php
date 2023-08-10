<?php

namespace Modules\BaseAdminLTE3\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select extends Component {

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
    /**
     * @var null
     */
    public $labelClass;
    /**
     * @var null
     */
    public $divClass;
    /**
     * @var null
     */
    public int $max;
    /**
     * @var null
     */
    public $create;
    /**
     * @var null
     */
    public $options;
    /**
     * @var null
     */
    public $value;
    /**
     * @var null
     */
    public $action;
    public bool $object;
    /**
     * @var null
     */
    public $field;
    /**
     * @var null
     */
    public $load;
    /**
     * @var null
     */
    public $createLoad;

    /**
     * Text constructor.
     *
     * @param $name
     * @param null $label
     * @param null $field
     * @param bool $horizontal
     * @param bool $autofocus
     * @param null $placeholder
     * @param bool $required
     * @param bool $disabled
     * @param null $fieldLength
     * @param null $inputClass
     * @param null $divClass
     * @param null $labelClass
     * @param int $max
     * @param null $create
     * @param null $options
     * @param null $value
     * @param null $action
     * @param bool $object
     * @param null $load
     */
    public function __construct($name, $label = null,$field = null, $horizontal = true, $autofocus = false, $placeholder = null, $required = false, $disabled = false, $fieldLength = null, $inputClass = null, $divClass = null, $labelClass = null, int $max = 1, $create = null, $options = null, $value = null, $action = null, $object = true,$load = null,$createLoad = null) {
        $this->name        = $name;
        $this->label       = $label;
        $this->placeholder = $placeholder;
        $this->required    = $required;
        $this->horizontal  = $horizontal;

        $this->fieldLength = $fieldLength;

        $this->setInputClass($inputClass);
        $this->setLabelClass($labelClass);
        $this->setDivClass($divClass);

        $this->disabled = $disabled;

        $this->autofocus = $autofocus;
        $this->max       = $max;
        $this->create    = $create;

        $this->options = $options;
        $this->value   = $value;
        $this->action  = $action;
        $this->load = $load;

        $this->object = $object;
        $this->field  = $field ?? str_replace(['[', ']'], ['.', ''], $name);

        $this->createLoad = $createLoad;
    }


    public function setDivClass($divClass): void {
        $collect = collect();

        if ($divClass) {
            $collect->push($divClass);
        } else {
            $collect->push('col-sm-8');//default if not custom
        }

        $this->divClass = $collect->implode(' ');
    }

    public function setLabelClass($labelClass): void {
        $collect = collect();

        if ($this->horizontal) {
            $collect->push('col-form-label'); //default
        }

        if ($this->required) {
            $collect->push('required'); //default
        }

        if ($labelClass) {
            $collect->push($labelClass);
        } else {
            $collect->push('text-left text-md-right col-sm-4'); //default if not custom
        }


        $this->labelClass = $collect->implode(' ');
    }

    public function setInputClass($inputClass): void {
        $collect = collect();
        $collect->push('form-control selectize');

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
        return $this->horizontal ? view('baseadminlte3::components.inputs.select.select-component-h') : view('baseadminlte3::components.inputs.select.select-component-v');
    }
}
