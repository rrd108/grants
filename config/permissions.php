<?php
return [
    'Users.SimpleRbac.permissions' => [
        [
            'role' => 'user',
            'controller' => 'Histories',
            'action' => ['showInProgress', 'add'],
        ],
        [
            'role' => 'user',
            'controller' => 'CompaniesGrants',
            'action' => ['edit', 'view'],
        ],
        [
            'role' => 'user',
            'controller' => 'Grants',
            'action' => ['view'],
        ],
        [
            'role' => '*',
            'controller' => 'Pages',
            'action' => ['display'],
        ],
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ['profile', 'logout'],
        ],
        [
            'role' => '*',
            'controller' => 'CompaniesGrants',
            'action' => ['index'],
        ],
    ]
];
