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

    'accepted'             => ':attribute deve ser aceito.',
    'active_url'           => ':attribute não é uma URL válida.',
    'after'                => ':attribute deve conter uma data posterior a :date.',
    'after_or_equal'       => ':attribute deve conter uma data igual ou posterior a :date.',
    'alpha'                => ':attribute deve conter somente letras.',
    'alpha_dash'           => ':attribute só pode conter letras, números e traços.',
    'alpha_num'            => ':attribute deve conter apenas letras e números.',
    'array'                => ':attribute deve ser um array.',
    'before'               => ':attribute deve conter uma data anterior a :date.',
    'before_or_equal'      => ':attribute deve conter uma data igual ou anterior a :date.',
    'between'              => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file'    => ':attribute deve estar entre :min e :max kilobytes.',
        'string'  => ':attribute deve ter entre :min e :max caracteres.',
        'array'   => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => ':attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'a confirmação do campo :attribute não combina.',
    'date'                 => ':attribute não é uma data válida.',
    'date_format'          => ':attribute não segue o formato :format.',
    'different'            => ':attribute e :other devem ser diferentes.',
    //'digits'               => ':attribute must be :digits digits.',
    //'digits_between'       => ':attribute must be between :min and :max digits.',
    'dimensions'           => ':attribute tem um tamanho inválido.',
    'distinct'             => ':attribute tem um valor duplicado.',
    'email'                => ':attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'selected :attribute é inválido.',
    'file'                 => ':attribute deve ser um arquivo.',
    'filled'               => ':attribute deve ser preenchido.',
    'image'                => ':attribute deve ser uma imagem.',
    'in'                   => 'a opção :attribute é inválida.',
    'in_array'             => ':attribute não existe em :other.',
    'integer'              => ':attribute deve ser um número inteiro.',
    'ip'                   => ':attribute deve ser um endereço de IP válido.',
    'ipv4'                 => ':attribute deve ser um endereço de IPv4 válido.',
    'ipv6'                 => ':attribute deve ser um endereço de IPv6 válido.',
    'json'                 => ':attribute deve ser uma string JSON válida.',
    'max'                  => [
        'numeric' => ':attribute não pode ser maior que :max.',
        'file'    => ':attribute não pode ser maior que :max kilobytes.',
        'string'  => ':attribute não pode ser maior que :max characters.',
        'array'   => ':attribute não pode ter mais que :max itens.',
    ],
    'mimes'                => ':attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => ':attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute deve ser no mínimo :min.',
        'file'    => ':attribute deve ser no mínimo :min kilobytes.',
        'string'  => ':attribute deve ser no mínimo :min characters.',
        'array'   => ':attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'a opção :attribute é inválida.',
    'numeric'              => ':attribute deeve ser um número.',
    'present'              => ':attribute deve estar presente.',
    'regex'                => ':attribute format é inválida.',
    'required'             => ':attribute é necessário.',
    'required_if'          => ':attribute é necessário quando :other é :value.',
    'required_unless'      => ':attribute é necessário a menos que :other esteja em :values.',
    'required_with'        => ':attribute é necessário quando :values estiver presente.',
    'required_with_all'    => ':attribute é necessário quando :values estiver presente.',
    'required_without'     => ':attribute é necessário quando :values não está presente.',
    'required_without_all' => ':attribute é necessário quando nada em :values estiver presente.',
    'same'                 => ':attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute deve ter o tamanho :size.',
        'file'    => ':attribute deve ter :size kilobytes.',
        'string'  => ':attribute deve ter :size caracteres.',
        'array'   => ':attribute deve conter :size itens.',
    ],
    'string'               => ':attribute deve ser uma string.',
    'timezone'             => ':attribute deve ser uma timezone válida.',
    'unique'               => ':attribute já foi cadastrado.',
    'uploaded'             => ':attribute falhou no upload.',
    'url'                  => 'o formato de :attribute é inválido.',

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
