<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            //'users' => 'c,r,u,d',
            //'profile' => 'r,u'
        ],
        'direction_commercial' => [],
        'commercial' => [],
        'direction_technique' => [],
        "bureau_d'etudes" => [],
        'administratif' => [],
        'direction' => [],
        'technicien' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
