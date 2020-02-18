<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'questions' => 'c,r,u,d,s',
            'places' => 'c,r,d',


        ],
        'admin' => [],


    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'send',
    ]
];
