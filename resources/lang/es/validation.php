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
    'accepted'             => 'El campo :attribute debe ser aceptado',
    'active_url'           => 'El campo :attribute no es una URL válida',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date',
    'alpha'                => 'El campo :attribute debe tener únicamente letras',
    'alpha_dash'           => 'El campo :attribute debe tener únicamente letras, números y guiones',
    'alpha_num'            => 'El campo :attribute debe tener únicamente letras y números',
    'array'                => 'El campo :attribute debe ser un array',
    'before'               => 'El campo :attribute debe ser una fecha inferior a :date',
    'between'              => [
        'numeric' => 'El campo :attribute debe tener un valor entre :min y :max.',
        'file'    => 'El campo :attribute debe tener un valor entre :min y :max kb',
        'string'  => 'El campo :attribute debe tener un valor entre :min y :max caracteres',
        'array'   => 'El campo :attribute debe tener una cantidad de items entre :min y :max',
    ],
    'boolean'              => 'El campo :attribute debe ser true o false',
    'confirmed'            => 'El campo :attribute de confirmación no coincide',
    'date'                 => 'El campo :attribute no es una fecha válida',
    'date_format'          => 'El campo :attribute no cumple con el formato :format',
    'different'            => 'El campo :attribute y :other deben ser diferentes',
    'digits'               => 'El campo :attribute debe tener :digits dígitos',
    'digits_between'       => 'El campo :attribute debe tener entre :min y :max dígitos',
    'email'                => 'El campo :attribute debe ser una dirección de email válida',
    'filled'               => 'El campo :attribute es requerido',
    'exists'               => 'El atributo elegido :attribute es inválido',
    'image'                => 'El campo :attribute debe ser una imagen',
    'in'                   => 'El atributo elegido :attribute es inválido',
    'integer'              => 'El campo :attribute debe ser un número entero',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida',
    'json'                 => 'El campo :attribute debe ser una cadena JSON válida',
    'max'                  => [
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'file'    => 'El campo :attribute no debe ser mayor de :max kn',
        'string'  => 'El campo :attribute no debe ser mayor a :max caracteres',
        'array'   => 'El campo :attribute no debe tener más de :max elementos',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo del tipo type: :values',
    'min'                  => [
        'numeric' => 'El campo :attribute debe tener como valor mínimo :min',
        'file'    => 'El campo :attribute debe ser de al menos :min kb',
        'string'  => 'El campo :attribute debe tener al menos :min caracteres',
        'array'   => 'El campo :attribute debe tener al menos :min elementos',
    ],
    'not_in'               => 'El atributo :attribute no es válido',
    'numeric'              => 'El campo :attribute debe ser un número',
    'regex'                => 'El campo :attribute tiene un formato inválido',
    'required'             => 'El campo :attribute es requerido',
    'required_if'          => 'El campo :attribute es requerido cuando el campo :other tenga el valor :value',
    'required_with'        => 'El campo :attribute es requerido cuando el valor :values esta presente',
    'required_with_all'    => 'El campo :attribute es requerido cuando el valor :values esta presente',
    'required_without'     => 'El campo :attribute es requerido cuando el valor :values no esta presente',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de los valores :values estan presentes',
    'same'                 => 'El campo :attribute y :other deben coincidir',
    'size'                 => [
        'numeric' => 'El campo :attribute debe tener un tamaño de :size dígitos',
        'file'    => 'El campo :attribute debe tener un peso de :size kb',
        'string'  => 'El campo :attribute debe tener una longitud de :size caracteres',
        'array'   => 'El campo :attribute debe tener un tamaño de :size elementos',
    ],
    'unique'               => 'El campo :attribute ya se encuentra registrado',
    'url'                  => 'El campo :attribute tiene un formato inválido',
    'timezone'             => 'El campo :attribute debe corresponderse a una zona válida',
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