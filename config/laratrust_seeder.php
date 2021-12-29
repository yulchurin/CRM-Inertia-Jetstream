<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'owner' => [
            'company' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'papers' => 'c,r,u,d',
            'parents' =>  'c,r,u,d',
            'profile' => 'r,u',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'papers' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'teacher' => [
            'users' => 'r',
        ],
        'instructor' => [
            'users' => 'r',
        ],
        'student' => [
            'profile' => 'r,u',
        ],
        'graduated' => [
            'profile' => 'r',
        ],
        'enrollee' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
