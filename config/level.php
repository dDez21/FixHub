<?php

/* gestisco i vari livelli */
return [
    'guest' => [
        ['label' => 'Chi siamo',         'route' => 'home'],
        ['label' => 'Dove trovarci',     'route' => 'where'],
        ['label' => 'Catalogo prodotti', 'route' => 'catalog'],
    ],

    'tech' => [
        ['label' => 'Chi siamo',         'route' => 'home'],
        ['label' => 'Dove trovarci',     'route' => 'where'],
        ['label' => 'Catalogo prodotti', 'route' => 'catalog'],
    ],

    'staff' => [
        ['label' => 'Catalogo prodotti', 'route' => 'catalog'],
    ],

    'admin' => [
        ['label' => 'Utenti',            'route' => 'admin.users'],
        ['label' => 'Dove trovarci',     'route' => 'where'],
        ['label' => 'Catalogo prodotti', 'route' => 'catalog'],
    ],
];
