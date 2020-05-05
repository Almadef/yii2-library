<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mysql-test;dbname=yii2-library-test',
            'username' => 'user',
            'password' => 'user123',
            'charset' => 'utf8',
            'tablePrefix' => 'yii2-library_',
        ],
    ],
];
