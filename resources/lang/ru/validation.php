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

    'accepted'             => 'The :attribute должен быть принят.',
    'active_url'           => 'The :attribute не является действительным URL',
    'after'                => 'The :attribute должна быть дата после :date.',
    'after_or_equal'       => 'The :attribute должна быть дата после или равна :date.',
    'alpha'                => 'The :attribute может содержать только буквы.',
    'alpha_dash'           => 'The :attribute может содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num'            => 'The :attribute может содержать только буквы и цифры.',
    'array'                => 'The :attribute должен быть массивом.',
    'before'               => 'The :attribute должно быть дата до :date.',
    'before_or_equal'      => 'The :attribute должна быть дата до или равна :date.',
    'between'              => [
        'numeric' => 'The :attribute должен быть между :min и :max.',
        'file'    => 'The :attribute должен быть между :min и :max килобайт.',
        'string'  => 'The :attribute должен быть между :min и :max персонажи.',
        'array'   => 'The :attribute должно быть между :min и :max Предметы.',
    ],
    'boolean'              => 'The :attribute поле должно быть истинным или ложным.',
    'confirmed'            => 'The :attribute подтверждение не совпадает.',
    'date'                 => 'The :attribute недействительная дата',
    'date_equals'          => 'The :attribute должна быть дата, равная :date.',
    'date_format'          => 'The :attribute не соответствует формату :format.',
    'different'            => 'The :attribute и :other должен быть другим.',
    'digits'               => 'The :attribute должно быть :digits цифры.',
    'digits_between'       => 'The :attribute должен быть между :min и :max цифры.',
    'dimensions'           => 'The :attribute имеет недопустимые размеры изображения.',
    'distinct'             => 'The :attribute поле имеет повторяющееся значение.',
    'email'                => 'The :attribute Адрес эл. почты должен быть действительным.',
    'ends_with'            => 'The :attribute должен заканчиваться одним из следующих: :values.',
    'exists'               => 'The выбранный :attribute является недействительным.',
    'file'                 => 'The :attribute должен быть файл.',
    'filled'               => 'The :attribute поле должно иметь значение.',
    'gt'                   => [
        'numeric' => 'The :attribute должно быть больше чем :value.',
        'file'    => 'The :attribute должно быть больше чем :value килобайт.',
        'string'  => 'The :attribute должно быть больше чем :value персонажи.',
        'array'   => 'The :attribute должно иметь больше, чем :value Предметы.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute должно быть больше или равно :value.',
        'file'    => 'The :attribute должно быть больше или равно :value килобайт.',
        'string'  => 'The :attribute должно быть больше или равно :value персонажи.',
        'array'   => 'The :attribute must have :value предметы или больше.',
    ],
    'image'                => 'The :attribute должно быть изображение.',
    'in'                   => 'The выбранный :attribute является недействительным.',
    'in_array'             => 'The :attribute поле не существует в :other.',
    'integer'              => 'The :attribute должно быть целым числом',
    'ip'                   => 'The :attribute должен быть действительный IP-адрес.',
    'ipv4'                 => 'The :attribute должен быть действительным адресом IPv4.',
    'ipv6'                 => 'The :attribute должен быть действительным адресом IPv6.',
    'json'                 => 'The :attribute должна быть допустимой строкой JSON.',
    'lt'                   => [
        'numeric' => 'The :attribute должно быть меньше чем :value.',
        'file'    => 'The :attribute должно быть меньше чем :value килобайт.',
        'string'  => 'The :attribute должно быть меньше чем :value персонажи.',
        'array'   => 'The :attribute должно быть меньше чем :value Предметы.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute должно быть меньше или равно :value.',
        'file'    => 'The :attribute должно быть меньше или равно :value килобайт.',
        'string'  => 'The :attribute должно быть меньше или равно :value персонажи.',
        'array'   => 'The :attribute must not have more than :value Предметы.',
    ],
    'max'                  => [
        'numeric' => 'The :attribute не может быть больше чем :max.',
        'file'    => 'The :attribute не может быть больше чем :max килобайт.',
        'string'  => 'The :attribute may not be greater than :max персонажи.',
        'array'   => 'The :attribute may not have more than :max Предметы.',
    ],
    'mimes'                => 'The :attribute должен быть файл типа: :values.',
    'mimetypes'            => 'The :attribute должен быть файл типа: :values.',
    'min'                  => [
        'numeric' => 'The :attribute должен быть не менее :min.',
        'file'    => 'The :attribute должен быть не менее :min килобайт.',
        'string'  => 'The :attribute должен быть не менее :min персонажи.',
        'array'   => 'The :attribute должен иметь по крайней мере :min Предметы.',
    ],
    'not_in'               => 'The выбранный :attribute является недействительным.',
    'not_regex'            => 'The :attribute Формат недействителен.',
    'numeric'              => 'The :attribute должно быть числом.',
    'password'             => 'Пароль неверен.',
    'present'              => 'The :attribute поле должно присутствовать.',
    'regex'                => 'The :attribute Формат недействителен.',
    'required'             => 'The :attribute Поле, обязательное для заполнения.',
    'required_if'          => 'The :attribute поле обязательно для заполнения, когда :other является :value.',
    'required_unless'      => 'The :attribute поле обязательно для заполнения, если :other является в :values.',
    'required_with'        => 'The :attribute поле обязательно для заполнения, когда :values является present.',
    'required_with_all'    => 'The :attribute поле обязательно для заполнения, когда :values присутствуют.',
    'required_without'     => 'The :attribute поле обязательно для заполнения, когда :values является не настоящее время.',
    'required_without_all' => 'The :attribute поле обязательно для заполнения, когда ни один из :values присутствуют.',
    'same'                 => 'The :attribute и :other должен совпадать.',
    'size'                 => [
        'numeric' => 'The :attribute должно быть :size.',
        'file'    => 'The :attribute должно быть :size килобайт.',
        'string'  => 'The :attribute должно быть :size персонажи.',
        'array'   => 'The :attribute должен содержать :size Предметы.',
    ],
    'starts_with'          => 'The :attribute должен начинаться с одного из следующих: :values.',
    'string'               => 'The :attribute должен быть строкой.',
    'timezone'             => 'The :attribute должна быть действительной зоной.',
    'unique'               => 'The :attribute уже занят.',
    'uploaded'             => 'The :attribute не удалось загрузить.',
    'url'                  => 'The :attribute Формат недействителен.',
    'uuid'                 => 'The :attribute должен быть действительным UUID.',

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
