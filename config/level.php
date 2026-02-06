<?php

/* gestisco i vari livelli */
return [
    'guest' => [
        ['label' => 'Chi siamo',         'path' => '/'],
        ['label' => 'Dove trovarci',     'path' => 'pages/where'],
        ['label' => 'Catalogo prodotti', 'path' => 'pages/catalog'],
    ],

    'tech' => [
        ['label' => 'Chi siamo',         'path' => '/'],
        ['label' => 'Dove trovarci',     'path' => 'pages/where'],
        ['label' => 'Catalogo prodotti', 'path' => 'pages/catalog'],
    ],

    'staff' => [
        ['label' => 'Catalogo prodotti', 'path' => 'pages/catalog'],
    ],

    'admin' => [
        ['label' => 'Utenti',            'path' => '/'], // cambia path quando hai la route admin vera
        ['label' => 'Dove trovarci',     'path' => 'pages/where'],
        ['label' => 'Catalogo prodotti', 'path' => 'pages/catalog'],
    ],
];
