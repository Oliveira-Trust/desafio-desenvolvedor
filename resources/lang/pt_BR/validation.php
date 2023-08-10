<?php

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

return [
    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute deve conter uma URL válida.',
    'after'                => 'O campo :attribute deve conter uma data posterior a :date.',
    'after_or_equal'       => 'O campo :attribute deve conter uma data superior ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números e traços.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números .',
    'array'                => 'O campo :attribute deve conter um array.',
    'attached'             => 'This :attribute is already attached.',
    'before'               => 'O campo :attribute deve conter uma data anterior a :date.',
    'before_or_equal'      => 'O campo :attribute deve conter uma data inferior ou igual a :date.',
    'between'              => [
        'array'   => 'O campo :attribute deve conter de :min a :max itens.',
        'file'    => 'O campo :attribute deve conter um arquivo de :min a :max kilobytes.',
        'numeric' => 'O campo :attribute deve conter um número entre :min e :max.',
        'string'  => 'O campo :attribute deve conter entre :min a :max caracteres.',
    ],
    'boolean'              => 'O campo :attribute deve conter o valor verdadeiro ou falso.',
    'confirmed'            => 'A confirmação para o campo :attribute não coincide.',
    'date'                 => 'O campo :attribute não contém uma data válida.',
    'date_equals'          => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'A data informada para o campo :attribute não respeita o formato :format.',
    'different'            => 'Os campos :attribute e :other devem conter valores diferentes.',
    'digits'               => 'O campo :attribute deve conter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve conter entre :min a :max dígitos.',
    'dimensions'           => 'O valor informado para o campo :attribute não é uma dimensão de imagem válida.',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => 'O campo :attribute não contém um endereço de email válido.',
    'ends_with'            => 'O campo :attribute deve terminar com um dos seguintes valores: :values',
    'exists'               => 'O valor selecionado para o campo :attribute é inválido.',
    'file'                 => 'O campo :attribute deve conter um arquivo.',
    'filled'               => 'O campo :attribute é obrigatório.',
    'gt'                   => [
        'array'   => 'O campo :attribute deve ter mais que :value itens.',
        'file'    => 'O arquivo :attribute deve ser maior que :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'string'  => 'O campo :attribute deve ser maior que :value caracteres.',
    ],
    'gte'                  => [
        'array'   => 'O campo :attribute deve ter :value itens ou mais.',
        'file'    => 'O arquivo :attribute deve ser maior ou igual a :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'string'  => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
    ],
    'image'                => 'O campo :attribute deve conter uma imagem.',
    'in'                   => 'O campo :attribute não contém um valor válido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve conter um número inteiro.',
    'ip'                   => 'O campo :attribute deve conter um IP válido.',
    'ipv4'                 => 'O campo :attribute deve conter um IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve conter um IPv6 válido.',
    'json'                 => 'O campo :attribute deve conter uma string JSON válida.',
    'lt'                   => [
        'array'   => 'O campo :attribute deve ter menos que :value itens.',
        'file'    => 'O arquivo :attribute ser menor que :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'string'  => 'O campo :attribute deve ser menor que :value caracteres.',
    ],
    'lte'                  => [
        'array'   => 'O campo :attribute não deve ter mais que :value itens.',
        'file'    => 'O arquivo :attribute ser menor ou igual a :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'string'  => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
    ],
    'max'                  => [
        'array'   => 'O campo :attribute deve conter no máximo :max itens.',
        'file'    => 'O campo :attribute não pode conter um arquivo com mais de :max kilobytes.',
        'numeric' => 'O campo :attribute não pode conter um valor superior a :max.',
        'string'  => 'O campo :attribute não pode conter mais de :max caracteres.',
    ],
    'mimes'                => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve conter um arquivo do tipo: :values.',
    'min'                  => [
        'array'   => 'O campo :attribute deve conter no mínimo :min itens.',
        'file'    => 'O campo :attribute deve conter um arquivo com no mínimo :min kilobytes.',
        'numeric' => 'O campo :attribute deve conter um número superior ou igual a :min.',
        'string'  => 'O campo :attribute deve conter no mínimo :min caracteres.',
    ],
    'multiple_of'          => 'The :attribute must be a multiple of :value',
    'not_in'               => 'O campo :attribute contém um valor inválido.',
    'not_regex'            => 'O formato do valor :attribute é inválido.',
    'numeric'              => 'O campo :attribute deve conter um valor numérico.',
    'password'             => 'A senha está incorreta.',
    'present'              => 'O campo :attribute deve estar presente.',
    'prohibited'           => 'O campo :attribute is prohibited.',
    'prohibited_if'        => 'O campo :attribute é proibido quanto :other é :value.',
    'prohibited_unless'    => 'O campo :attribute é proibidounless :other is in :values.',
    'regex'                => 'O formato do valor informado no campo :attribute é inválido.',
    'relatable'            => 'This :attribute may not be associated with this resource.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando o valor do campo :other é igual a :value.',
    'required_unless'      => 'O campo :attribute é obrigatório a menos que :other esteja presente em :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando um dos :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
    'same'                 => 'Os campos :attribute e :other devem conter valores iguais.',
    'size'                 => [
        'array'   => 'O campo :attribute deve conter :size itens.',
        'file'    => 'O campo :attribute deve conter um arquivo com o tamanho de :size kilobytes.',
        'numeric' => 'O campo :attribute deve conter o número :size.',
        'string'  => 'O campo :attribute deve conter :size caracteres.',
    ],
    'starts_with'          => 'O campo :attribute deve começar com um dos seguintes valores: :values',
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve conter um fuso horário válido.',
    'unique'               => 'O valor informado para o campo :attribute já está em uso.',
    'uploaded'             => 'Falha no Upload do arquivo :attribute.',
    'url'                  => 'O formato da URL informada para o campo :attribute é inválido.',
    'uuid'                 => 'O campo :attribute deve ser um UUID válido.',


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

    'passcheck'          => 'Sua senha antiga está incorreta',
    'password.different' => 'Sua senha nova é igual a senha antiga',
    'less_equal'         => 'O campo :attribute deverá conter um valor menor ou igual a :other.',
    'less'               => 'O campo :attribute deverá conter um valor menor que :other.',
    'more_equal'         => 'O campo :attribute deverá conter um valor maior ou igual a :other.',
    'month_year'         => 'O campo :attribute não contém uma data válida no formato mês/ano.',
    'date_more_equal'    => 'O campo :attribute deverá conter uma data maior ou igual a :other.',
    'more'               => 'O campo :attribute deverá conter um valor maior que :other.',

    'site' => 'O campo :attribute não contém uma url válida.',

    "time"           => "O campo :attribute não contém uma hora válida.",
    "money"          => "O campo :attribute não contém um valor em moeda válida",
    "money_min"      => "O campo :attribute deverá ter um valor superior ou igual a R$ :min.",
    "decimal_format" => "O campo :attribute deverá conter no máximo :precision  digitos e :scale decimais.",
    "money_format"   => "O campo :attribute deverá conter no máximo :precision  digitos e :scale decimais.",
    "array_size"     => "Você só pode entrar :array_size valores diferentes para :attribute.",
    'cpf'            => 'O campo :attribute não contém um CPF válido.',
    'cnpj'           => 'O campo :attribute não contém um CNPJ válido.',
    "equals"         => "O campo :attribute não contém um valor válido.",
    "phone"          => "O campo :attribute não contém um número válido.",
    'color'          => 'O campo :attribute não contém uma cor válida.',
    "alpha_spaces"   => 'O :attribute deve conter somente letras e espaços.',
    "username"       => 'O :attribute deve conter somente letras, numeros, hifens e underscore',
    "username_lower" => 'O :attribute deve conter somente letras em minusculo, numeros, hifens e underscore',
    "name"           => 'O :attribute não contém um valor válido',
    "full_name"      => 'O :attribute deve ser seu nome completo',
    'slug'           => 'O :attribute deve conter somente letras em minusculo, numeros, hifens e underscore',
    'iunique'        => 'O valor informado para o campo :attribute já está em uso.',
    'recaptcha'      => 'Valide o captcha',

    'custom'     => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'attributes' => [
        'address'                => 'Endereço',
        'age'                    => 'Idade',
        'body'                   => 'Conteúdo',
        'city'                   => 'Cidade',
        'country'                => 'País',
        'date'                   => 'Data',
        'day'                    => 'Dia',
        'description'            => 'Descrição',
        'email'                  => 'E-mail',
        'excerpt'                => 'Resumo',
        'first_name'             => 'Primeiro Nome',
        'gender'                 => 'Gênero',
        'hour'                   => 'Hora',
        'last_name'              => 'Sobrenome',
        'message'                => 'Mensagem',
        'minute'                 => 'Minuto',
        'mobile'                 => 'Celular',
        'month'                  => 'Mês',
        'name'                   => 'Nome',
        'password'               => 'Senha',
        'password_confirmation'  => 'Confirmação da senha',
        'phone'                  => 'Telefone',
        'remember'               => 'Lembrar-me',
        'second'                 => 'Segundo',
        'sex'                    => 'Sexo',
        'state'                  => 'Estado',
        'subject'                => 'Assunto',
        'text'                   => 'Texto',
        'time'                   => 'Hora',
        'title'                  => 'Título',
        'username'               => 'Usuário',
        'year'                   => 'Ano'
    ],
];
