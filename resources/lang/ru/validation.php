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

    'accepted'             => 'Атрибут :attribute должен быть принят.',
    'active_url'           => ':attribute не является допустимым URL-адресом',
    'after'                => ':attribute должна быть дата после :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры и тире.',
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должен быть массивом.',
    'before'               => ':attribute должна быть дата до :date.',
    'between'              => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file'    => ':attribute должно быть между :min и :max Кб.',
        'string'  => ':attribute должно быть между :min и :max ситмволов.',
        'array'   => ':attribute должно быть между :min и :max пунктов.',
    ],
    'boolean'              => ':attribute поле должно быть true и false.',
    'confirmed'            => ':attribute подтверждение не соответствует.',
    'date'                 => ':attribute не является допустимой датой.',
    'date_format'          => ':attribute не соответствует формату :format.',
    'different'            => ':attribute и :other различны',
    'digits'               => ':attribute должно быть :digits цифр.',
    'digits_between'       => ':attribute должно быть между :min и :max цифр.',
    'distinct'             => ':attribute поле имеет повторяющееся значение.',
    'email'                => 'Адрес эл. почты :attribute должен быть действительным.',
    'exists'               => 'Выбраное :attribute невалидно.',
    'filled'               => ':attribute поле обезательно.',
    'image'                => ':attribute должна быть картинка',
    'in'                   => 'Выбраное :attribute невалидно.',
    'in_array'             => ':attribute field does not exist in :other.',
    'integer'              => 'The :attribute должно быть целым числом.',
    'ip'                   => ':attribute должен быть действительным IP-адресом.',
    'json'                 => ':attribute должен быть JSON строкой.',
    'max'                  => [
        'numeric' => ':attribute не должно быть больше, чем :max.',
        'file'    => ':attribute не должно быть больше, чем :max Кб.',
        'string'  => ':attribute не должно быть больше, чем :max символов.',
        'array'   => ':attribute не должно быть больше, чем :max значение.',
    ],
    'mimes'                => ':attribute долженг быть файл type: :values.',
    'min'                  => [
        'numeric' => ':attribute должено быть не менее :min.',
        'file'    => ':attribute должен быть не менее :min Кб.',
        'string'  => ':attribute должно быть не менее :min символов.',
        'array'   => ':attribute должно быть не менее :min пунктов.',
    ],
    'not_in'               => 'Выбраное :attribute невалидно.',
    'numeric'              => ':attribute должно бытьчислом.',
    'present'              => ':attribute поле должно присутствовать.',
    'regex'                => ':attribute формат недействителен.',
    'required'             => ':attribute поле обязательное для заполнения.',
    'required_if'          => ':attribute поле обязательное :other из :value.',
    'required_unless'      => ':attribute поле обязательно, если  :other имеет не менее :values.',
    'required_with'        => ':attribute поле обязательно с :values',
    'required_with_all'    => ':attribute поле обязательно, когда :values присутсвуют',
    'required_without'     => ':attribute поле обязательно, когда :values отсутсвуют',
    'required_without_all' => ':attribute поле требуется, если ни одно из значений из :values не сущесвуют',
    'same'                 => ':attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должно быть :size.',
        'file'    => ':attribute должно быть :size Кб.',
        'string'  => ':attribute должно быть :size символов.',
        'array'   => ':attribute должно включать :size пунктов.',
    ],
    'string'               => ':attribute должна быть строкою.',
    'timezone'             => ':attribute должна быть действительной часовым поясом',
    'unique'               => ':attribute уже был взят',
    'url'                  => ':attribute формат недействителен.',

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
