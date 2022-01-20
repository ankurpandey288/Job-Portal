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

    'accepted'             => '的 :attribute 必须被接受.',
    'active_url'           => '的 :attribute 不是有效的网址。',
    'after'                => '的 :attribute 必须是之后的日期 :date.',
    'after_or_equal'       => '的 :attribute 必须是等于或小于等于的日期 :date.',
    'alpha'                => '的 :attribute 只能包含字母.',
    'alpha_dash'           => '的 :attribute 只能包含字母，数字，破折号和下划线。',
    'alpha_num'            => '的 :attribute 只能包含字母和数字.',
    'array'                => '的 :attribute 必须是一个数组.',
    'before'               => '的 :attribute 必须是一个日期之前 :date.',
    'before_or_equal'      => '的 :attribute 必须是早于或等于的日期 :date.',
    'between'              => [
        'numeric' => '的 :attribute 必须介于 :min 和 :max.',
        'file'    => '的 :attribute 必须介于 :min 和 :max 千字节.',
        'string'  => '的 :attribute 必须介于 :min 和 :max 人物.',
        'array'   => '的 :attribute 必须介于 :min 和 :max 项目.',
    ],
    'boolean'              => '的 :attribute 字段必须为true或false。.',
    'confirmed'            => '的 :attribute 确认不符.',
    'date'                 => '的 :attribute 不是有效日期.',
    'date_equals'          => '的 :attribute 日期必须等于 :date.',
    'date_format'          => '的 :attribute 与格式不符 :format.',
    'different'            => '的 :attribute 和 :other 必须不同.',
    'digits'               => '的 :attribute 一定是 :digits 数字.',
    'digits_between'       => '的 :attribute 必须介于 :min 和 :max 数字.',
    'dimensions'           => '的 :attribute 图片尺寸无效.',
    'distinct'             => '的 :attribute 字段具有重复值.',
    'email'                => '的 :attribute 必须是一个有效的E-mail地址.',
    'ends_with'            => '的 :attribute 必须以以下任一结尾: :values.',
    'exists'               => '的 已选 :attribute 是无效的.',
    'file'                 => '的 :attribute 必须是一个文件.',
    'filled'               => '的 :attribute 字段必须有一个值.',
    'gt'                   => [
        'numeric' => '的 :attribute 必须大于 :value.',
        'file'    => '的 :attribute 必须大于 :value 千字节.',
        'string'  => '的 :attribute 必须大于 :value 人物.',
        'array'   => '的 :attribute 必须超过 :value 项目.',
    ],
    'gte'                  => [
        'numeric' => '的 :attribute 必须大于或等于 :value.',
        'file'    => '的 :attribute 必须大于或等于 :value 千字节.',
        'string'  => '的 :attribute 必须大于或等于 :value 人物.',
        'array'   => '的 :attribute 一定有 :value 项以上.',
    ],
    'image'                => '的 :attribute 必须是图像.',
    'in'                   => '的 已选 :attribute 是无效的.',
    'in_array'             => '的 :attribute 字段不存在于 :other.',
    'integer'              => '的 :attribute 必须是整数.',
    'ip'                   => '的 :attribute 必须是有效的IP地址.',
    'ipv4'                 => '的 :attribute 必须是有效的IPv4地址.',
    'ipv6'                 => '的 :attribute 必须是有效的IPv6地址.',
    'json'                 => 'v :attribute 必须是有效的JSON字符串.',
    'lt'                   => [
        'numeric' => '的 :attribute 必须小于 :value.',
        'file'    => '的 :attribute 必须小于 :value 千字节.',
        'string'  => '的 :attribute 必须小于 :value 人物.',
        'array'   => '的 :attribute 必须少于 :value 项目.',
    ],
    'lte'                  => [
        'numeric' => '的 :attribute 必须小于或等于 :value.',
        'file'    => '的 :attribute 必须小于或等于 :value 千字节.',
        'string'  => '的 :attribute 必须小于或等于 :value 人物.',
        'array'   => '的 :attribute 不得超过 :value 项目.',
    ],
    'max'                  => [
        'numeric' => '的 :attribute 不得大于 :max.',
        'file'    => '的 :attribute 不得大于 :max 千字节.',
        'string'  => '的 :attribute 不得大于 :max 人物.',
        'array'   => '的 :attribute 可能不超过 :max 项目.',
    ],
    'mimes'                => '的 :attribute 必须是类型的文件: :values.',
    'mimetypes'            => '的 :attribute 必须是类型的文件: :values.',
    'min'                  => [
        'numeric' => '的 :attribute 必须至少 :min.',
        'file'    => '的 :attribute 必须至少 :min 千字节.',
        'string'  => '的 :attribute 必须至少 :min 人物.',
        'array'   => '的 :attribute 必须至少 :min 项目.',
    ],
    'not_in'               => '的 已选 :attribute 是无效的.',
    'not_regex'            => '的 :attribute 格式无效.',
    'numeric'              => '的 :attribute 必须是一个数字.',
    'password'             => '的 密码错误.',
    'present'              => '的 :attribute 字段必须存在.',
    'regex'                => '的 :attribute 格式无效.',
    'required'             => '的 :attribute 必填项.',
    'required_if'          => '的 :attribute 何时需要该字段 :other 是 :value.',
    'required_unless'      => '的 :attribute 必填字段，除非 :other 在 :values.',
    'required_with'        => '的 :attribute 何时需要该字段 :values 存在.',
    'required_with_all'    => '的 :attribute 何时需要该字段 :values 存在.',
    'required_without'     => '的 :attribute 何时需要该字段 :values 不存在.',
    'required_without_all' => '的 :attribute 如果没有 :values 存在.',
    'same'                 => '的 :attribute 和 :other 必须匹配.',
    'size'                 => [
        'numeric' => '的 :attribute 一定是 :size.',
        'file'    => '的 :attribute 一定是 :size 千字节.',
        'string'  => '的 :attribute 一定是 :size 人物.',
        'array'   => '的 :attribute 必须包含 :size 项目.',
    ],
    'starts_with'          => '的 :attribute 必须以下列其中一项开头: :values.',
    'string'               => '的 :attribute 必须是一个字符串.',
    'timezone'             => '的 :attribute 必须是有效区域.',
    'unique'               => '的 :attribute 已有人带走了.',
    'uploaded'             => '的 :attribute 上传失败.',
    'url'                  => '的 :attribute 格式无效.',
    'uuid'                 => '的 :attribute 必须是有效的UUID.',

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
