<?php

return [

    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    "products" => [
        'controller' => "product",
        'action' => 'index'
    ],

    "products/:id" => [
        'controller' => "product",
        'action' => 'show',
        'dynamic' => true
    ],

    "products/:id/delete" => [
        'controller' => "product",
        'action' => 'delete',
        "dynamic" => true
    ],
];