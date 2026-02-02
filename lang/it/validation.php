<?php

// errori di validazione dati
return [
    'required' => 'Il campo :attribute è obbligatorio.',
    'string' => 'Il campo :attribute non accetta questo formato di dati, deve essere una stringa.',
    'min' => [
        'string' => ':attribute deve avere almeno :min caratteri.',
    ],
    'confirmed' => 'Il campo :attribute non coincide.',

    'custom' => [
        'username' => [
            'required' => 'Lo username è obbligatorio.',
        ],
        'password' => [
            'required' => 'La password è obbligatoria.',
        ],
    ],

    'attributes' => [
        'username' => 'Username',
        'password' => 'Password',
    ],
];
