<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    ''accepted'        => 'L'attribut doit être accepté.',
    'active_url'      => "L'attribut n'est pas une URL valide.",
    'after'           => 'L'attribut doit être une date postérieure au :date.',
    'after_or_equal'  => 'L'attribut doit être une date postérieure ou égale au :date.',
    'alpha'           => 'L'attribut peut contenir uniquement des lettres.',
    'alpha_dash'      => 'L'attribut  contenir uniquement des lettres, des chiffres et des tirets.',
    'alpha_num'       => 'L'attribut peut contenir uniquement des chiffres et des lettres.',
    'array'           => 'Le champ :attribut doit être un tableau.',
    'before'          => 'Le champ :attribut doit être une date antérieure au :date.',
    'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
    'between'         => [
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'file'    => 'La taille du fichier d'attribut doit être comprise entre :min et :max kilo-octets.',
        'string'  => 'L'attribut doit contenir entre :min et :max caractères.',
        'array'   => 'L' attribut doit contenir entre :min et :max éléments.',
    ],
    'boolean'        => 'Le champ d'attribut doit être vrai ou faux.',
    'confirmed'      => 'La date d'attribut ne correspond pas.',
    'date'           => "L'attribut n'est pas une date valide.",
    'date_equals'    => 'L'attribut doit être une date égale à :date.',
    'date_format'    => 'L'attribut ne correspond pas au format :format.',
    'different'      => 'L'attribut et :des autres doivent être différents.',
    'digits'         => 'L''attribut doit contenir :les chiffres. ',
    'digits_between' => 'L'attribut doit contenir entre :min et :max chiffres.',
    'dimensions'     => "La taille de l'image n'est pas conforme à 'L'attribut",
    'distinct'       => 'Le champ d'attribut a une valeur en double.',
    'email'          => 'L'attribut doit être une adresse email valide.',
    'ends_with'      => 'L'attribut doit se terminer avec une des valeurs suivantes ',
    'exists'         => 'L'attribute sélectionné est invalide.',
    'file'           => L'attribut doit être un fichier.',
    'filled'         => 'Le champ d'attribut doit avoir une valeur.',
    'gt'             => [
        'numeric' => 'L'attribut doit être supérieure à :valueur,
        'file'    => 'L'attribut doit être supérieure à valeur kilo-octets.',
        'string'  => 'L'attribut doit contenir plus de :value caractères.',
        'array'   => 'L' attribut doit contenir plus des éléments de valeur,
    ],
    'gte' => [
        'numeric' => 'L'attribut doit être supérieure ou égale à :valueur',
        'file'    => 'L'attribut doit être supérieure ou égale à :value kilo-octets.',
        'string'  => 'L'attribut doit être superieur ou égale  caractères de valeurs.
        'array'   => 'L'attribut doit contenir led elements de valeur ou plus de valeur ',
    ],
    'image'    => 'L'attribut doit être une image.',
    'in'       => 'L'attribut est invalide.',
    'in_array' => "Le champ d'attribut n'existe pas dans l'autre.",
    'integer'  => 'L'attribut doit être un entier.',
    'ip'       => 'L'attribut doit être une adresse IP valide.',
    'ipv4'     => 'L'attribut doit être une adresse IPv4 valide.',
    'ipv6'     => 'L'attribut doit être une adresse IPv6 valide.',
    'json'     => 'L'attribut doit être une valide document de JSON .',
    'lt'       => [
        'numeric' => 'L'attribut doit être moins à :value.',
        'file'    => 'L'attribut doit être moins à :value kilo-octets.',
        'string'  => 'L'attribut doit contenir moins de caractères de valeurs',
        'array'   => 'L'attribut doit contenir moins d'éléments de valeur
    ],
    'lte' => [
        'numeric' => 'L'attribut doit être moins ou égale à :valueur ',
        'file'    => 'La taille du fichier de :attribute doit être inférieure ou égale à :value kilo-octets.',
        'string'  => 'L'attribut doit contenir moins ou plus :value caractères.',
        'array'   => 'L' attribut doit contenir au plus :value éléments.',
    ],
    'max' => [
        'numeric' => 'La valeur d'attribut ne peut pas être supérieure à :max.',
        'file'    => 'La taille du fichier de :attribute ne peut pas être plus de :max kilo-octets.',
        'string'  => 'Le texte d'attribut ne peut pas contenir plus de :max caractères.',
        'array'   => 'L'attribut ne peut pas contenir plus de :max éléments.',
    ],
    'mimes'     => 'L'attribut doit être un fichier de type : :valeurs.',
    'mimetypes' => 'L'attribut doit être un fichier de type : :valueurs.',
    'min'       => [
        'numeric' => 'L'attribut doit être du moins :min.',
   

     'file'    => 'La taille du fichier d'attribut doit être du moins :min kilo-octets.',
        'string'  => 'L'attribut doit être du moins :min caractères.',
        'array'   => 'L'attribut doit contenir au moins :min éléments.',
    ],
    'not_in'   => "L'attribute sélectionné n'est pas valide.",
    'not_regex'     => "Le format d'attribut n'est pas valide.",
    'numeric'   => 'L' attribut doit être un nombre.',
    'password'      => 'Le mot de passe est incorrect',
    'present'    => 'L' attribut doit être présent.',
    'regex'      => 'Le format d' attribut est invalide.',
    'required' => 'Le champ d'attribut est obligatoire.',
    'required_if'          => 'Le champ d'attribut est obligatoire quand :l' autre est :value.',
    'required_unless'      => 'Le champ d'attribut est obligatoire sauf si : l' autre est dans les :valeurs.',
    'required_with'        => 'Le champ d'attribut est obligatoire quand :valueur est présent.',
    'required_with_all'    => 'Le champ d'attribut est obligatoire quand :valeurs sont présents.',
    'required_without'     => "Le champ d'attribut est obligatoire quand :values n'est pas présent.",
    'required_without_all' => "Le champ d'attribut est requis quand aucun de :valeurs ne sont pas présent.",
    'same'                 => 'L'attribut et :l' autre doivent être identiques.',
    'size'                 => [
        'numeric' => 'La valeur de :attribute doit être :taille.',
        'file'    => 'La taille du fichier d'attribut doit être de :taille kilo-octets.',
        'string'  => 'L'attribut doit être de :size caractères.',
        'array'   => 'L'attribut doit contenir des éléments de taille. 
    ],
    'starts_with' => 'L'attribut doit commencer avec une des valeurs suivantes ',
    'string'      => 'L'attribut doit être une chaîne de caractères.',
    'timezone'    => 'L'attribut doit être une zone valide.',
    'unique'      => 'L'attribut est déjà utilisée.',
    'uploaded'    => "L'attribut n'a pu être téléchargé .",
    'url'         => "Le format d'attribut n'est pas valide.",
    'uuid'        => 'L' attribut doit être un UUID valide',

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

    'attributes' => [
        'name'                  => 'nom',
        'username'              => "nom d'utilisateur",
        'email'                 => 'E mail',
        'first_name'            => 'prénom',
        'last_name'             => 'nom',
        'password'              => 'mot de passe',
        'password_confirmation' => 'confirmation du mot de passe',
        'city'                  => 'ville',
        'country'               => 'pays',
        'address'               => 'adresse',
        'phone'                 => 'téléphone',
        'mobile'                => 'portable',
        'age'                   => 'âge',
        'sex'                   => 'sexe',
        'gender'                => 'genre',
        'day'                   => 'jour',
        'month'                 => 'mois',
        'year'                  => 'année',
        'hour'                  => 'heure',
        'minute'                => 'minute',
        'second'                => 'seconde',
        'title'                 => 'titre',
        'content'               => 'contenu',
        'description'           => 'description',
        'excerpt'               => 'extrait',
        'date'                  => 'date',
        'time'                  => 'temps',
        'available'             => 'disponible',
        'size'                  => 'taille',
   

    ],
];
