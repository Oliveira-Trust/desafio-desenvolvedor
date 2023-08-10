<?php

if ( ! function_exists('bs4_error')) {

    function bs4_error($expression = null, $value = null) {
        if (isNotEmpty($expression) && Session::has('errors') && Session::get('errors')->has($expression)) {
           if ($value) {
               return ' '.$value;
           }

            return '<div class="invalid-feedback">'.Session::get('errors')->first($expression).'</div>';
        }
    }
}
