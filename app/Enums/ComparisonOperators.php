<?php

namespace App\Enums;

interface Symbolic
{
    public function getLabel(): string;
}

enum ComparisonOperators: string implements Symbolic
{
    case EQUAL = '==';
    case NOT_EQUAL = '!=';
    case GREATER_THAN = '>';
    case LESS_THAN = '<';
    case GREATER_THAN_OR_EQUAL = '>=';
    case LESS_THAN_OR_EQUAL = '<=';

    // Método que retorna a legenda do operador
    public function getLabel(): string
    {
        return match($this) {
            ComparisonOperators::EQUAL => 'equal',
            ComparisonOperators::NOT_EQUAL => 'not_equal',
            ComparisonOperators::GREATER_THAN => 'greater_than',
            ComparisonOperators::LESS_THAN => 'less_than',
            ComparisonOperators::GREATER_THAN_OR_EQUAL => 'greater_than_or_equal',
            ComparisonOperators::LESS_THAN_OR_EQUAL => 'less_than_or_equal',
        };
    }

    // Método estático para obter o símbolo a partir da legenda
    public static function fromLabel(string $label): ?ComparisonOperators
    {
        return match($label) {
            'equal' => ComparisonOperators::EQUAL,
            'not_equal' => ComparisonOperators::NOT_EQUAL,
            'greater_than' => ComparisonOperators::GREATER_THAN,
            'less_than' => ComparisonOperators::LESS_THAN,
            'greater_than_or_equal' => ComparisonOperators::GREATER_THAN_OR_EQUAL,
            'less_than_or_equal' => ComparisonOperators::LESS_THAN_OR_EQUAL,
            default => null,
        };
    }

    // Método estático para obter a legenda a partir do símbolo
    public static function fromSymbol(string $symbol): ?string
    {
        switch ($symbol) {
            case '==':
                return 'equal';
            case '!=':
                return 'not_equal';
            case '>':
                return 'greater_than';
            case '<':
                return 'less_than';
            case '>=':
                return 'greater_than_or_equal';
            case '<=':
                return 'less_than_or_equal';
            default:
                return null;
        }
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes
        {
            public function get($model, string $key, $value, array $attributes)
            {
                return ComparisonOperators::fromSymbol($value);
            }

            public function set($model, string $key, $value, array $attributes)
            {
                return $value instanceof ComparisonOperators ? $value->value : $value;
            }
        };
    }
}
