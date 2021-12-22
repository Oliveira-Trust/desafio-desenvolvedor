<?php

namespace App\Enums;

use ReflectionClass;

/**
 * Enum
 * Classe base para criação de um enum
 */
abstract class Enum
{    
    /**
     * all
     * Função que retorna um array com todas as constantes da classe do tipo Enum
     * @return array
     */
    public static function all() : array
    {
        $class = new ReflectionClass(get_called_class());
        return $class->getConstants();
    }
}
