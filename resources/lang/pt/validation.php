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

    'accepted'             => 'O :attribute deve ser aceito.',
    'active_url'           => 'O :attribute não é um URL válido.',
    'after'                => 'O :attribute deve ser uma data depois :date.',
    'after_or_equal'       => 'O :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O :attribute pode conter apenas letras.',
    'alpha_dash'           => 'O :attribute pode conter apenas letras, números, traços e sublinhados.',
    'alpha_num'            => 'O :attribute pode conter apenas letras e números.',
    'array'                => 'O :attribute deve ser uma matriz.',
    'before'               => 'O :attribute deve ser uma data antes :date.',
    'before_or_equal'      => 'O :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O :attribute deve estar entre :min e :max.',
        'file'    => 'O :attribute deve estar entre :min e :max kilobytes.',
        'string'  => 'O :attribute deve estar entre :min e :max personagens.',
        'array'   => 'O :attribute deve estar entre :min e :max Itens.',
    ],
    'boolean'              => 'O :attribute O campo deve ser verdadeiro ou falso.',
    'confirmed'            => 'O :attribute confirmação não corresponde.',
    'date'                 => 'O :attribute não é uma data válida.',
    'date_equals'          => 'O :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O :attribute não corresponde ao formato :format.',
    'different'            => 'O :attribute e :other deve ser diferente.',
    'digits'               => 'O :attribute devemos ser :digits dígitos.',
    'digits_between'       => 'O :attribute deve estar entre :min e :max dígitos.',
    'dimensions'           => 'O :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O :attribute campo tem um valor duplicado.',
    'email'                => 'O :attribute Deve ser um endereço de e-mail válido.',
    'ends_with'            => 'O :attribute deve terminar com um dos seguintes: :values.',
    'exists'               => 'O selecionada :attribute é inválido.',
    'file'                 => 'O :attribute deve ser um arquivo',
    'filled'               => 'O :attribute O campo deve ter um valor.',
    'gt'                   => [
        'numeric' => 'O :attribute deve ser maior que :value.',
        'file'    => 'O :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O :attribute deve ser maior que :value personagens.',
        'array'   => 'O :attribute deve ser maior que :value Itens.',
    ],
    'gte'                  => [
        'numeric' => 'O :attribute deve ser maior ou igual :value.',
        'file'    => 'O :attribute deve ser maior ou igual :value kilobytes.',
        'string'  => 'O :attribute deve ser maior ou igual :value personagens.',
        'array'   => 'O :attribute deve ter :value itens ou mais.',
    ],
    'image'                => 'O :attribute deve ser uma imagem.',
    'in'                   => 'O selecionada :attribute é inválido.',
    'in_array'             => 'O :attribute campo não existe em :other.',
    'integer'              => 'O :attribute deve ser um número inteiro.',
    'ip'                   => 'O :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O :attribute deve ser uma sequência JSON válida.',
    'lt'                   => [
        'numeric' => 'O :attribute deve ser menor que :value.',
        'file'    => 'O :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O :attribute deve ser menor que :value personagens.',
        'array'   => 'O :attribute deve ser menor que :value Itens.',
    ],
    'lte'                  => [
        'numeric' => 'O :attribute deve ser menor ou igual :value.',
        'file'    => 'O :attribute deve ser menor ou igual :value kilobytes.',
        'string'  => 'O :attribute deve ser menor ou igual :value personagens.',
        'array'   => 'O :attribute deve ser menor ou igual :value Itens.',
    ],
    'max'                  => [
        'numeric' => 'O :attribute não pode ser maior que :max.',
        'file'    => 'O :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'O :attribute não pode ser maior que :max personagens.',
        'array'   => 'O :attribute não pode ser maior que :max Itens.',
    ],
    'mimes'                => 'O :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O :attribute deve ser pelo menos :min.',
        'file'    => 'O :attribute deve ser pelo menos :min kilobytes.',
        'string'  => 'O :attribute deve ser pelo menos :min personagens.',
        'array'   => 'O :attribute deve ter pelo menos :min Itens.',
    ],
    'not_in'               => 'O selecionada :attribute é inválido.',
    'not_regex'            => 'O :attribute formato é inválido.',
    'numeric'              => 'O :attribute deve ser um número.',
    'password'             => 'O password está incorreto.',
    'present'              => 'O :attribute campo deve estar presente.',
    'regex'                => 'O :attribute formato inválido.',
    'required'             => 'O :attribute campo é obrigatório.',
    'required_if'          => 'O :attribute campo é obrigatório quando :other é :value.',
    'required_unless'      => 'O :attribute campo é obrigatório, a menos que :other é no :values.',
    'required_with'        => 'O :attribute campo é obrigatório quando :values é presente.',
    'required_with_all'    => 'O :attribute campo é obrigatório quando :values estão presentes.',
    'required_without'     => 'O :attribute campo é obrigatório quando :values é não presente.',
    'required_without_all' => 'O :attribute campo é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'O :attribute e :other deve combinar.',
    'size'                 => [
        'numeric' => 'O :attribute devemos ser :size.',
        'file'    => 'O :attribute devemos ser :size kilobytes.',
        'string'  => 'O :attribute devemos ser :size personagens.',
        'array'   => 'O :attribute deve conter :size Itens.',
    ],
    'starts_with'          => 'O :attribute deve começar com um dos seguintes: :values.',
    'string'               => 'O :attribute deve ser uma string.',
    'timezone'             => 'O :attribute deve ser uma zona válida.',
    'unique'               => 'O :attribute já foi tomada.',
    'uploaded'             => 'O :attribute falha ao carregar.',
    'url'                  => 'O :attribute formato inválido.',
    'uuid'                 => 'O :attribute deve ser um UUID válido.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
