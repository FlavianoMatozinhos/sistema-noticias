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

    'accepted'             => 'O Campo :attribute deve ser aceptado.',
    'active_url'           => 'O Campo :attribute nao e uma URL válida.',
    'after'                => 'O Campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O Campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O Campo :attribute so pode conter letras.',
    'alpha_dash'           => 'O Campo :attribute so pode conter letras, números, guiones e guiones bajos.',
    'alpha_num'            => 'O Campo :attribute so pode conter letras y números.',
    'array'                => 'O Campo :attribute deve ser um array.',
    'before'               => 'O Campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O Campo :attribute deve ser uma data anterior o igual a :date.',
    'between'              => [
        'numeric' => 'O Campo :attribute deve ser um valor entre :min e :max.',
        'file'    => 'El arquivo :attribute deve pesar entre :min e :max kilobytes.',
        'string'  => 'O Campo :attribute deve conter entre :min e :max caracteres.',
        'array'   => 'O Campo :attribute deve conter entre :min e :max elementos.',
    ],
    'boolean'              => 'O Campo :attribute deve ser verdadero ou falso.',
    'confirmed'            => 'O Campo confirmacao de :attribute no coincide.',
    'date'                 => 'O Campo :attribute nao corresponde com uma data válida.',
    'date_equals'          => 'O Campo :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O Campo :attribute nao corresponde com o formato de data :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O Campo :attribute deve ser um número de :digits dígitos.',
    'digits_between'       => 'O Campo :attribute deve conter entre :min e :max dígitos.',
    'dimensions'           => 'O Campo :attribute tem dimensiones de imagen inválidas.',
    'distinct'             => 'O Campo :attribute tem um valor duplicado.',
    'email'                => 'O Campo :attribute deve ser uma direcao de correo válida.',
    'ends_with'            => 'O Campo :attribute deve finalizar com algum dos seguintes valores: :values',
    'exists'               => 'O Campo :attribute selecionado nao existe.',
    'file'                 => 'O Campo :attribute deve ser um arquivo.',
    'filled'               => 'O Campo :attribute deve conter um valor.',
    'gt'                   => [
        'numeric' => 'O Campo :attribute deve ser maior que :value.',
        'file'    => 'O arquivo :attribute deve pesar mais de :value kilobytes.',
        'string'  => 'O Campo :attribute deve conter mais de :value caracteres.',
        'array'   => 'O Campo :attribute deve conter mais de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => 'O Campo :attribute deve ser mayor o igual a :value.',
        'file'    => 'O arquivo :attribute deve pesar :value o mais kilobytes.',
        'string'  => 'O Campo :attribute deve conter :value o mais caracteres.',
        'array'   => 'O Campo :attribute deve conter :value o mais elementos.',
    ],
    'image'                => 'O Campo :attribute deve ser uma imagem.',
    'in'                   => 'O Campo :attribute e inválido.',
    'in_array'             => 'O Campo :attribute nao existe em :other.',
    'integer'              => 'O Campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O Campo :attribute deve ser uma direcao IP válida.',
    'ipv4'                 => 'O Campo :attribute deve ser uma direcao IPv4 válida.',
    'ipv6'                 => 'O Campo :attribute deve ser uma direcao IPv6 válida.',
    'json'                 => 'O Campo :attribute deve ser uma cadena de texto JSON válida.',
    'lt'                   => [
        'numeric' => 'O Campo :attribute deve ser menor que :value.',
        'file'    => 'O arquivo :attribute deve pesar menos de :value kilobytes.',
        'string'  => 'O Campo :attribute deve conter menos de :value caracteres.',
        'array'   => 'O Campo :attribute deve conter menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'O Campo :attribute deve ser menor o igual a :value.',
        'file'    => 'O arquivo :attribute deve pesar :value o menos kilobytes.',
        'string'  => 'O Campo :attribute deve conter :value o menos caracteres.',
        'array'   => 'O Campo :attribute deve conter :value o menos elementos.',
    ],
    'max'                  => [
        'numeric' => 'O Campo :attribute nao deve ser maior a :max.',
        'file'    => 'O arquivo :attribute nao deve pesar mais de :max kilobytes.',
        'string'  => 'O Campo :attribute nao deve conter mais de :max caracteres.',
        'array'   => 'O Campo :attribute nao deve conter mais de :max elementos.',
    ],
    'mimes'                => 'O Campo :attribute deve ser um arquivo de tipo: :values.',
    'mimetypes'            => 'O Campo :attribute deve ser um arquivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'O Campo :attribute deve ser ao menos :min.',
        'file'    => 'O arquivo :attribute deve pesar ao menos :min kilobytes.',
        'string'  => 'O Campo :attribute deve conter ao menos :min caracteres.',
        'array'   => 'O Campo :attribute deve conter ao menos :min elementos.',
    ],
    'not_in'               => 'O Campo :attribute seleccionado e inválido.',
    'not_regex'            => 'O formato dO Campo :attribute e inválido.',
    'numeric'              => 'O Campo :attribute deve ser um número.',
    'password'             => 'La contraseña e incorrecta.',
    'present'              => 'O Campo :attribute deve estar presente.',
    'regex'                => 'O formato dO Campo :attribute e inválido.',
    'required'             => 'O Campo :attribute e obrigatorio.',
    'required_if'          => 'O Campo :attribute e obrigatorio quando O Campo :other e :value.',
    'required_umless'      => 'O Campo :attribute e requerido a menos que :other se encontra em :values.',
    'required_with'        => 'O Campo :attribute e obrigatorio quando :values está presente.',
    'required_with_all'    => 'O Campo :attribute e obrigatorio quando :values estao presentes.',
    'required_without'     => 'O Campo :attribute e obrigatorio quando :values no está presente.',
    'required_without_all' => 'O Campo :attribute e obrigatorio quando nenhum dos campos :values estao presentes.',
    'same'                 => 'Os campos :attribute e :other deven coincidir.',
    'size'                 => [
        'numeric' => 'O Campo :attribute deve ser :size.',
        'file'    => 'O arquivo :attribute deve pesar :size kilobytes.',
        'string'  => 'O Campo :attribute deve conter :size caracteres.',
        'array'   => 'O Campo :attribute deve conter :size elementos.',
    ],
    'starts_with'          => 'O Campo :attribute deve comecar com um dos seguintes valores: :values',
    'string'               => 'O Campo :attribute deve ser uma cadeia de caracteres.',
    'timezone'             => 'O Campo :attribute deve ser uma zona horaria válida.',
    'umique'               => 'O valor do Campo :attribute ja está em uso.',
    'uploaded'             => 'O Campo :attribute nao pode subir.',
    'url'                  => 'O formato do Campo :attribute e inválido.',
    'uuid'                 => 'O Campo :attribute deve ser um UUID válido.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
