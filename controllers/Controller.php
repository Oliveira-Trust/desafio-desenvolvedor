<?php

    abstract class Controller {

        public function __construct() {}

        // Define os métodos abstratos para serem usados por subclasses de Controller
        public abstract function index();
        public abstract function show();

    }

?>