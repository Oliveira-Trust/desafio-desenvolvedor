<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/19
 * Time: 10:19
 */
namespace App\MyClass;

class DependencyFiles extends \Danganf\MyClass\DependencyFiles
{
    const CSS_BOOT_SWITCH            = 'app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css';
    const CSS_FORM_SWITCH            = 'app-assets/css/plugins/forms/switch.css';
    const CSS_JQUERY_UI              = 'app-assets/vendors/css/ui/jquery-ui.min.css';
    const CSS_JQUERY_UI_2            = 'app-assets/css/plugins/ui/jqueryui.css';
    const JS_BOOT_SWITCH             = 'app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js';
    const JS_BOOT_CHECKBOX           = 'app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js';
    const JS_INPUT_MASK              = 'app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js';
    const JS_JQUERY_UI               = 'app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js';
    const JS_BUTTONS_SELECTS         = 'app-assets/js/scripts/ui/jquery-ui/buttons-selects.js';
    const JS_MASK_MONEY              = 'assets/js/jquery.maskMoney.min.js';
    const JS_CRUD                    = 'assets/js/cruds/main.js';

    public function __construct($routeName)
    {
        $routeName = str_replace('_duplicate', '', $routeName);
        parent::__construct($routeName);
        //dd($this->routename);
        $this->loadDefault();
    }

    public function loadDefault(){

        if( substr( $this->routename, -5 ) === 'Index' || strpos( $this->routename, 'Index' ) !== FALSE ){
            $this->js[] = $this::JS_CRUD;
        }
    }

    public function routeOrderPdv(){
        $this->css[] = $this::CSS_JQUERY_UI;
        $this->css[] = $this::CSS_JQUERY_UI_2;
        $this->js[]  = $this::JS_JQUERY_UI;
        $this->js[]  = $this::JS_BUTTONS_SELECTS;
    }

    public function routeCustomerEdit(){$this->routeCustomerNew();}
    public function routeCustomerNew()  {
        $this->addBootstrapSwitch();
        $this->js[] = $this::JS_INPUT_MASK;
    }

    public function routeCatalogEdit(){$this->routeCatalogNew();}
    public function routeCatalogNew()  {
        $this->addBootstrapSwitch();
        $this->js[] = $this::JS_MASK_MONEY;
    }

    private function addBootstrapSwitch(){
        $this->css[] = $this::CSS_BOOT_SWITCH;
        $this->css[] = $this::CSS_FORM_SWITCH;
        $this->js[]  = $this::JS_BOOT_SWITCH;
        $this->js[]  = $this::JS_BOOT_CHECKBOX;
    }

}
