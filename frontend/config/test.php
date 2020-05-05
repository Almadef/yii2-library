<?php

return [
    'id' => 'app-frontend-tests',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en-us', 'ru', 'en'],
            'showScriptName' => false,
            'enableLanguagePersistence' => false,
            'enableLanguageDetection' => false,
            'rules' => [
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],
];
