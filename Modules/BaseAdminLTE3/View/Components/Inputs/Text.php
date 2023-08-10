<?php

namespace Modules\BaseAdminLTE3\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\View\View;

class Text extends Component {

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
    public bool $autoresize;
    /**
     * @var null
     */
    public $rows;
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
    public $action;
    /**
     * @var null
     */
    public $value;
    /**
     * @var null
     */
    public $field;
    /**
     * @var null
     */
    public $dataFieldExtra;
    public $prepend;


    /**
     * Text constructor.
     *
     * @param $name
     * @param string $type
     * @param null $field
     * @param null $label
     * @param null $value
     * @param bool $horizontal
     * @param bool $autofocus
     * @param null $placeholder
     * @param bool $required
     * @param bool $disabled
     * @param null $fieldLength
     * @param null $inputClass
     * @param null $divClass
     * @param null $labelClass
     * @param null $rows
     * @param bool $autoresize
     * @param null $action
     * @param null $dataFielExtra
     */
    public function __construct($name, $type = 'text', $field = null, $label = null, $value = null, $horizontal = true, $autofocus = false, $placeholder = null, $required = false, $disabled = false, $fieldLength = null, $inputClass = null, $divClass = null, $labelClass = null, $rows = null, $autoresize = false, $action = null,$dataFieldExtra = null,$prepend = null) {
        $this->name        = $name;
        $this->label       = $label;
        $this->placeholder = $placeholder;
        $this->required    = $required;
        $this->horizontal  = $horizontal;
        $this->prepend  =  $prepend;

        $this->fieldLength = $fieldLength;

        $this->setInputClass($inputClass);
        $this->setLabelClass($labelClass);
        $this->setDivClass($divClass);

        $this->disabled = $disabled;

        $this->autofocus  = $autofocus;
        $this->type       = $type;
        $this->autoresize = $autoresize;

        $this->rows   = $rows;
        $this->action = $action;
        $this->value  = $value;
        $this->field  = $field ?? str_replace(['[', ']'], ['.', ''], $name);
        $this->dataFieldExtra = $dataFieldExtra;
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
        return $this->horizontal ? view('baseadminlte3::components.inputs.text.text-component-h') : view('baseadminlte3::components.inputs.text.text-component-v');
    }
}
