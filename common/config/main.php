<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'storage' => [
            'class' => 'snewer\storage\StorageManager',
            'buckets' => [
                'book' => [
                    'class' => 'snewer\storage\drivers\FileSystemDriver',
                    'basePath' => '@frontend/web/uploads/books/',
                    'baseUrl' => '@web/uploads/books/',
                    'depth' => 4
                ],
                'cover' => [
                    'class' => 'snewer\storage\drivers\FileSystemDriver',
                    'basePath' => '@frontend/web/uploads/covers/',
                    'baseUrl' => '@web/uploads/covers/',
                    'depth' => 4
                ],
            ]
        ],
    ],
];
