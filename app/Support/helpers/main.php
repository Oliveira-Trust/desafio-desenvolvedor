<?php

if (!function_exists('fm')) {
    function fm($value, $decimal = true, $zeroIsEmpty = false, $currency = null) {
        if (isNotEmpty($value, $zeroIsEmpty)) {
            if (is_numeric($value)) {
                $value = get_money_format($value, $decimal, zeroIsEmpty: $zeroIsEmpty);
                if ($currency) {
                    return set_currency($value, $currency);
                }
            }

            return $value;
        }
    }
}

if (!function_exists('set_currency')) {
    function set_currency($value, $currency = 'R$'): string {
        return $currency . ' ' . $value;
    }
}

if (!function_exists('get_money_format')) {
    function get_money_format($value, $decimal = true, $places = 2, $zeroIsEmpty = true, $divisor = 100) //format money
    {
        if ($value !== null && (!$zeroIsEmpty || $value != 0)) {
            if ($divisor) {
                $value /= $divisor;
            }

            return number_format($value, $decimal || is_decimal($value) ? $places : 0, ',', '.');
        }
    }
}

if (!function_exists('get_percent_format')) {
    function get_percent_format($value, $places = 1, $zeroIsEmpty = false) {
        if ($value !== null && (!$zeroIsEmpty || $value != 0)) {
            return number_format($value, is_decimal($value) ? $places : 0, ',', '.');
        }
    }
}

if (!function_exists('is_decimal')) {
    function is_decimal($val): bool {
        return is_numeric($val) && floor($val) != $val;
    }
}

if (!function_exists('set_float_format')) {
    function set_float_format(string|int|null $value): float|null {
        if (isNotEmpty($value)) {
            return str_replace(array('.', ','), array('', '.'), $value);
        }

        return null;
    }
}

if (!function_exists('set_money_format')) {
    function set_money_format($value = null): int|null //format money
    {
        if (isNotEmpty($value)) {
            if (!is_numeric($value)) {
                $value = (float) str_replace(array('.', ','), array('', '.'), $value);
            }

            return floor($value * 100);
        }

        return null;
    }
}

if (!function_exists('int_to_float')) {
    function int_to_float(int|string|null $value): float|null {
        if ($value) {
            return bcdiv((int)$value, 100,2);
        }

        return null;
    }
}


if ( ! function_exists('fieldDigits')) {
    function fieldDigits($field = null) {
        return field("$field.min") . ',' . field("$field.max");
    }
}


if ( ! function_exists('set_plural')) {
    function set_plural($value, $single, $plural) {
        if ($value) {
            return $value . ' ' . ($value > 1 ? $plural : $single);
        }

        return null;
    }
}

if ( ! function_exists('mask')) {
    function mask($mask, $str) {
        $str = str_replace(" ", "", $str);

        for ($i = 0, $iMax = strlen($str); $i < $iMax; $i ++) {
            $mask[ strpos($mask, "#") ] = $str[ $i ];
        }

        return $mask;

    }
}

if ( ! function_exists('isCpf')) {
    function isCpf($value) {
        return strlen($value) === fieldLength('common.cpf');
    }
}

if ( ! function_exists('get_doc_format')) {
    function get_doc_format($value) {
        if ($value) {
            return isCpf($value) ? mask('###.###.###-##', $value) : mask('##.###.###/####-##', $value);
        }
    }
}

if ( ! function_exists('set_doc_format')) {
    function set_doc_format($value) {
        if ($value) {
            return clear_string($value);
        }
    }
}

if ( ! function_exists('set_email_format')) {
    function set_email_format($email = null) {
        if (isNotEmpty($email)) {
            return strtolower(trim($email));
        }
    }
}

if ( ! function_exists('create_index')) {
    function create_index($table, $search = 'name') {
        $index = $table . '_unaccent_' . $search . '_trgm_idx';

        return DB::statement("CREATE INDEX $index ON $table USING gin (f_unaccent($search) gin_trgm_ops);");
    }
}

if (!function_exists('fieldLength')) {
    function fieldLength($field = null, $namespace = null) {
        $namespace = $namespace ? $namespace . '.' : null;

        if (Config::has($namespace . "attributes.$field.length")) {
            return Config::get($namespace . "attributes.$field.length");
        }

        if (Config::has($namespace . "attributes.$field.max")) {
            return Config::get($namespace . "attributes.$field.max");
        }

        return 255;
    }
}

if (!function_exists('get_locate')) {
    function get_locate() {
        return str_replace("-", "_", app()->getLocale());
    }
}

if (!function_exists('route_name')) {
    function route_name($route = null) {
        $name = null;

        $routes = $route ? Route::getRoutes()->getByName($route) : Route::getCurrentRoute();

        if ($routes) {
            $action = $routes->getAction();

            if ($name = Arr::get($action, 'name')) {
                if (is_array($name)) {
                    return $name[0];
                }

                return $name;
            }
        }

        return $name;
    }
}

if (!function_exists('clear_string')) {
    function clear_string($value) {
        return null_if_empty(preg_replace('/\D+/', '', $value));
    }
}

if (!function_exists('null_if_empty')) {
    function null_if_empty($value) {
        return isNotEmpty($value, true) ? $value : null;
    }
}

if (!function_exists('isNotEmpty')) {
    function isNotEmpty($value, $zero_is_empty = false) {
        if ($value === null) {
            return false;
        }

        if (is_array($value)) {
            return !empty($value);
        }

        $res = trim($value) > null;

        if ($zero_is_empty && is_numeric($value)) {
            return $res && $value != 0;
        }

        return $res;
    }
}

if (!function_exists('field')) {
    function field($field, $keys = false) {
        $data = config("attributes.$field");

        return $keys ? array_keys($data) : $data;
    }
}

if (!function_exists('fieldDefault')) {
    function fieldDefault($field = null, &$modal = null) {
        return $modal ? null : field("$field.default");
    }
}
