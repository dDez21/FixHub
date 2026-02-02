<?php

/* gestisco i vari livelli */
return [
    'guest' => [
        ['label' => 'Chi siamo',         'path' => '/'],
        ['label' => 'Dove trovarci',     'path' => 'guest/where'],
        ['label' => 'Catalogo prodotti', 'path' => 'guest/catalog'],
    ],

    'tech' => [
        ['label' => 'Chi siamo',         'path' => '/'],
        ['label' => 'Dove trovarci',     'path' => 'guest/where'],
        ['label' => 'Catalogo prodotti', 'path' => 'guest/catalog'],
    ],

    'staff' => [
        ['label' => 'Catalogo prodotti', 'path' => 'guest/catalog'],
    ],

    'admin' => [
        ['label' => 'Utenti',            'path' => '/'], // cambia path quando hai la route admin vera
        ['label' => 'Dove trovarci',     'path' => 'guest/where'],
        ['label' => 'Catalogo prodotti', 'path' => 'guest/catalog'],
    ],
];
