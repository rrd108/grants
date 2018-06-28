<?php
return [
    'Users.SimpleRbac.permissions' => [
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
    ]
];
