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

    'accepted'             => 'ال attribute: يجب قبوله.',
    'active_url'           => 'ال attribute: ليس عنوان URL صالحًا.',
    'after'                => 'ال attribute: يجب أن يكون تاريخًا بعد date:.',
    'after_or_equal'       => 'ال attribute: يجب أن يكون تاريخًا بعد أو يساوي date:.',
    'alpha'                => 'ال attribute: قد تحتوي على أحرف فقط.',
    'alpha_dash'           => 'ال attribute: قد تحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num'            => 'ال attribute: قد تحتوي فقط على أحرف وأرقام.',
    'array'                => 'ال attribute: يجب أن يكون مصفوفة.',
    'before'               => 'ال attribute: يجب أن يكون تاريخ قبل date:.',
    'before_or_equal'      => 'ال attribute: يجب أن يكون تاريخًا قبل أو يساوي date:.',
    'between'              => [
        'numeric' => 'ال attribute: يجب ان يكون وسطا min: و max:.',
        'file'    => 'ال attribute: يجب ان يكون وسطا min: و max: كيلو بايت.',
        'string'  => 'ال attribute: يجب ان يكون وسطا min: و max: الشخصيات.',
        'array'   => 'ال attribute: يجب أن يكون بين min: و max: العناصر.',
    ],
    'boolean'              => 'ال attribute: يجب أن يكون الحقل صحيحًا أو خطأ.',
    'confirmed'            => 'ال attribute: التأكيد غير متطابق.',
    'date'                 => 'ال attribute: هذا ليس تاريخ صحيح.',
    'date_equals'          => 'ال attribute: يجب أن يكون تاريخًا مساويًا لـ date:.',
    'date_format'          => 'ال attribute: لا يتطابق مع الشكل format:.',
    'different'            => 'ال attribute: و other: يجب أن تكون مختلف.',
    'digits'               => 'ال attribute: لا بد وأن digits: أرقام.',
    'digits_between'       => 'ال attribute: يجب ان يكون وسطا min: و max: أرقام.',
    'dimensions'           => 'ال attribute: أبعاد الصورة غير صالحة.',
    'distinct'             => 'ال attribute: الحقل له قيمة مكررة.',
    'email'                => 'ال attribute: يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with'            => 'ال attribute: يجب أن ينتهي بواحد مما يلي: values:.',
    'exists'               => 'ال المحدد attribute: غير صالح.',
    'file'                 => 'ال attribute: يجب أن يكون ملفًا.',
    'filled'               => 'ال attribute: يجب أن يكون للحقل قيمة.',
    'gt'                   => [
        'numeric' => 'ال attribute: يجب أن يكون أكبر من value:.',
        'file'    => 'ال attribute: يجب أن يكون أكبر من كيلو value: بايت.',
        'string'  => 'ال attribute: يجب أن يكون أكبر من value: الشخصيات.',
        'array'   => 'ال attribute: يجب أن يكون أكثر من value: العناصر.',
    ],
    'gte'                  => [
        'numeric' => 'ال attribute: يجب أن يكون أكبر من أو يساوي value:.',
        'file'    => 'ال attribute: يجب أن يكون أكبر من أو يساوي value: كيلو بايت.',
        'string'  => 'ال attribute: يجب أن يكون أكبر من أو يساوي value: الشخصيات.',
        'array'   => 'ال attribute: يجب ان يملك value: من العناصر أو أكثر.',
    ],
    'image'                => 'ال attribute: يجب أن تكون صورة.',
    'in'                   => 'ال المحدد attribute: غير صالح.',
    'in_array'             => 'ال attribute: الحقل غير موجود في other:.',
    'integer'              => 'ال attribute: يجب أن يكون صحيحا.',
    'ip'                   => 'ال attribute: يجب أن يكون عنوان IP صالحًا.',
    'ipv4'                 => 'ال attribute: يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6'                 => 'ال attribute: يجب أن يكون عنوان IPv6 صالحًا.',
    'json'                 => 'ال attribute: يجب أن تكون سلسلة JSON صالحة.',
    'lt'                   => [
        'numeric' => 'ال attribute: يجب أن يكون أقل من value:.',
        'file'    => 'ال attribute: يجب أن يكون أقل من value: كيلو بايت.',
        'string'  => 'ال attribute: يجب أن يكون أقل من value: الشخصيات.',
        'array'   => 'ال attribute: يجب أن يكون أقل من value: العناصر.',
    ],
    'lte'                  => [
        'numeric' => 'ال attribute: يجب أن يكون أصغر من أو يساوي value:.',
        'file'    => 'ال attribute: يجب أن يكون أصغر من أو يساوي value: كيلو بايت.',
        'string'  => 'ال attribute: يجب أن يكون أصغر من أو يساوي value: الشخصيات.',
        'array'   => 'ال attribute: يجب ألا يحتوي على أكثر من value: العناصر.',
    ],
    'max'                  => [
        'numeric' => 'ال attribute: قد لا يكون أكبر من max:.',
        'file'    => 'ال attribute: قد لا يكون أكبر من max: كيلو بايت.',
        'string'  => 'ال attribute: قد لا يكون أكبر من max: الشخصيات.',
        'array'   => 'ال attribute: قد لا يكون أكثر من max: العناصر.',
    ],
    'mimes'                => 'ال attribute: يجب أن يكون ملفًا من النوع: values:.',
    'mimetypes'            => 'ال attribute: يجب أن يكون ملفًا من النوع: values:.',
    'min'                  => [
        'numeric' => 'ال attribute: لا بد أن يكون على الأقل min:.',
        'file'    => 'ال attribute: لا بد أن يكون على الأقل min: كيلو بايت.',
        'string'  => 'ال attribute: لا بد أن يكون على الأقل min: الشخصيات.',
        'array'   => 'ال attribute: يجب أن يكون على الأقل min: العناصر.',
    ],
    'not_in'               => 'ال المحدد attribute: غير صالح.',
    'not_regex'            => 'ال attribute: التنسيق غير صالح.',
    'numeric'              => 'ال attribute: يجب أن يكون رقما.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'ال attribute: يجب أن يكون الحقل موجودًا.',
    'regex'                => 'ال attribute: التنسيق غير صالح.',
    'required'             => 'ال attribute: الحقل مطلوب.',
    'required_if'          => 'ال attribute: الحقل مطلوب عندما other: يكون value:.',
    'required_unless'      => 'ال attribute: الحقل مطلوب ما لم يكن other: في داخل values:.',
    'required_with'        => 'ال attribute: الحقل مطلوب عندما values: حاضر.',
    'required_with_all'    => 'ال attribute: الحقل مطلوب عندما values: حاضرون.',
    'required_without'     => 'ال attribute: الحقل مطلوب عندما values: غير موجود.',
    'required_without_all' => 'ال attribute: الحقل مطلوبًا في حالة عدم وجود أي من values: حاضرون.',
    'same'                 => 'ال attribute: و other: يجب أن تتطابق.',
    'size'                 => [
        'numeric' => 'ال attribute: لا بد وأن size:.',
        'file'    => 'ال attribute: لا بد وأن size: كيلو بايت.',
        'string'  => 'ال attribute: لا بد وأن size: الشخصيات.',
        'array'   => 'ال attribute: يجب أن يحتوي على size: العناصر.',
    ],
    'starts_with'          => 'ال attribute: يجب أن يبدأ بواحد مما يلي: values:.',
    'string'               => 'ال attribute: يجب أن يكون سلسلة.',
    'timezone'             => 'ال attribute: يجب أن تكون منطقة صالحة.',
    'unique'               => 'ال attribute: لقد اتخذت بالفعل.',
    'uploaded'             => 'ال attribute: فشل التحميل.',
    'url'                  => 'ال attribute: التنسيق غير صالح.',
    'uuid'                 => 'ال attribute: يجب أن يكون UUID صالحًا.',

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
