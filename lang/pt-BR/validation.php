<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => "O campo :attribute deve ser aceito.",
    "accepted_if" => "The :attribute must be accepted when :other is :value.",
    "active_url" => "O campo :attribute não é uma URL válida.",
    "after" => "O campo :attribute deve ser uma data posterior a :date.",
    "after_or_equal" => "O campo :attribute deve ser uma data posterior ou igual a :date.",
    "alpha" => "O campo :attribute só pode conter letras.",
    "alpha_dash" => "O campo :attribute só pode conter letras, números e traços.",
    "alpha_num" => "O campo :attribute só pode conter letras e números.",
    "array" => "O campo :attribute deve ser uma matriz.",
    "before" => "O campo :attribute deve ser uma data anterior :date.",
    "before_or_equal" => "O campo :attribute deve ser uma data anterior ou igual a :date.",
    "between" => [
        "array" => "O campo :attribute deve ter entre :min e :max itens.",
        "file" => "O campo :attribute deve ser entre :min e :max kilobytes.",
        "numeric" => "O campo :attribute deve ser entre :min e :max.",
        "string" => "O campo :attribute deve ser entre :min e :max caracteres."
    ],
    "boolean" => "O campo :attribute deve ser verdadeiro ou falso.",
    "confirmed" => "O campo :attribute de confirmação não confere.",
    "current_password" => "The password is incorrect.",
    "date" => "O campo :attribute não é uma data válida.",
    "date_equals" => "O campo :attribute deve ser uma data igual a :date.",
    "date_format" => "O campo :attribute não corresponde ao formato :format.",
    "declined" => "The :attribute must be declined.",
    "declined_if" => "The :attribute must be declined when :other is :value.",
    "different" => "Os campos :attribute e :other devem ser diferentes.",
    "digits" => "O campo :attribute deve ter :digits dígitos.",
    "digits_between" => "O campo :attribute deve ter entre :min e :max dígitos.",
    "dimensions" => "O campo :attribute tem dimensões de imagem inválidas.",
    "distinct" => "O campo :attribute campo tem um valor duplicado.",
    "email" => "O campo :attribute deve ser um endereço de e-mail válido.",
    "ends_with" => "O campo :attribute deve terminar com um dos seguintes: :values",
    "enum" => "The selected :attribute is invalid.",
    "exists" => "O campo :attribute selecionado é inválido.",
    "file" => "O campo :attribute deve ser um arquivo.",
    "filled" => "O campo :attribute deve ter um valor.",
    "gt" => [
        "array" => "O campo :attribute deve conter mais de :value itens.",
        "file" => "O campo :attribute deve ser maior que :value kilobytes.",
        "numeric" => "O campo :attribute deve ser maior que :value.",
        "string" => "O campo :attribute deve ser maior que :value caracteres."
    ],
    "gte" => [
        "array" => "O campo :attribute deve conter :value itens ou mais.",
        "file" => "O campo :attribute deve ser maior ou igual a :value kilobytes.",
        "numeric" => "O campo :attribute deve ser maior ou igual a :value.",
        "string" => "O campo :attribute deve ser maior ou igual a :value caracteres."
    ],
    "image" => "O campo :attribute deve ser uma imagem.",
    "in" => "O campo :attribute selecionado é inválido.",
    "in_array" => "O campo :attribute não existe em :other.",
    "integer" => "O campo :attribute deve ser um número inteiro.",
    "ip" => "O campo :attribute deve ser um endereço de IP válido.",
    "ipv4" => "O campo :attribute deve ser um endereço IPv4 válido.",
    "ipv6" => "O campo :attribute deve ser um endereço IPv6 válido.",
    "json" => "O campo :attribute deve ser uma string JSON válida.",
    "lt" => [
        "array" => "O campo :attribute deve conter menos de :value itens.",
        "file" => "O campo :attribute deve ser menor que :value kilobytes.",
        "numeric" => "O campo :attribute deve ser menor que :value.",
        "string" => "O campo :attribute deve ser menor que :value caracteres."
    ],
    "lte" => [
        "array" => "O campo :attribute não deve conter mais que :value itens.",
        "file" => "O campo :attribute deve ser menor ou igual a :value kilobytes.",
        "numeric" => "O campo :attribute deve ser menor ou igual a :value.",
        "string" => "O campo :attribute deve ser menor ou igual a :value caracteres."
    ],
    "mac_address" => "The :attribute must be a valid MAC address.",
    "max" => [
        "array" => "O campo :attribute não pode ter mais do que :max itens.",
        "file" => "O campo :attribute não pode ser superior a :max kilobytes.",
        "numeric" => "O campo :attribute não pode ser superior a :max.",
        "string" => "O campo :attribute não pode ser superior a :max caracteres."
    ],
    "mimes" => "O campo :attribute deve ser um arquivo do tipo: :values.",
    "mimetypes" => "O campo :attribute deve ser um arquivo do tipo: :values.",
    "min" => [
        "array" => "O campo :attribute deve ter pelo menos :min itens.",
        "file" => "O campo :attribute deve ter pelo menos :min kilobytes.",
        "numeric" => "O campo :attribute deve ser pelo menos :min.",
        "string" => "O campo :attribute deve ter pelo menos :min caracteres."
    ],
    "multiple_of" => "O campo :attribute deve ser um múltiplo de :value.",
    "not_in" => "O campo :attribute selecionado é inválido.",
    "not_regex" => "O campo :attribute possui um formato inválido.",
    "numeric" => "O campo :attribute deve ser um número.",
    "password" => "A senha está incorreta.",
    "present" => "O campo :attribute deve estar presente.",
    "prohibited" => "O campo :attribute é proibido.",
    "prohibited_if" => "O campo :attribute é proibido quando :other for :value.",
    "prohibited_unless" => "O campo :attribute é proibido exceto quando :other for :values.",
    "prohibits" => "The :attribute field prohibits :other from being present.",
    "regex" => "O campo :attribute tem um formato inválido.",
    "required" => "O campo :attribute é obrigatório.",
    "required_array_keys" => "The :attribute field must contain entries for: :values.",
    "required_if" => "O campo :attribute é obrigatório quando :other for :value.",
    "required_unless" => "O campo :attribute é obrigatório exceto quando :other for :values.",
    "required_with" => "O campo :attribute é obrigatório quando :values está presente.",
    "required_with_all" => "O campo :attribute é obrigatório quando :values está presente.",
    "required_without" => "O campo :attribute é obrigatório quando :values não está presente.",
    "required_without_all" => "O campo :attribute é obrigatório quando nenhum dos :values estão presentes.",
    "same" => "Os campos :attribute e :other devem corresponder.",
    "size" => [
        "array" => "O campo :attribute deve conter :size itens.",
        "file" => "O campo :attribute deve ser :size kilobytes.",
        "numeric" => "O campo :attribute deve ser :size.",
        "string" => "O campo :attribute deve ser :size caracteres."
    ],
    "starts_with" => "O campo :attribute deve começar com um dos seguintes valores: :values",
    "string" => "O campo :attribute deve ser uma string.",
    "timezone" => "O campo :attribute deve ser uma zona válida.",
    "unique" => "O campo :attribute já está sendo utilizado.",
    "uploaded" => "Ocorreu uma falha no upload do campo :attribute.",
    "url" => "O campo :attribute tem um formato inválido.",
    "uuid" => "O campo :attribute deve ser um UUID válido.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    "custom" => [
        "attribute-name" => [
            "rule-name" => "custom-message"
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    "attributes" => [
        'fee' => 'taxa',
        'origin_currency' => 'moeda de origem',
        'origin_currency_value' => 'valor da moeda de origem',
        'destination_currency_id' => 'moeda de destino',
        'destination_currency_value' => 'valor da moeda de destino',
        'convertion_fee' => 'taxa de conversão',
        'convertion_fee_value' => 'valor da taxa de conversão',
        'payment_fee' => 'taxa de pagamento',
        'payment_fee_value' => 'valor da taxa de pagamento',
        'payment_type_id' => 'forma de pagamento',
    ],

];
