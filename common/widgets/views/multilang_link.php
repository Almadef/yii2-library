<?php

use yii\helpers\Html;
use yii\helpers\Url;

if (Yii::$app->language == 'ru') {
    echo Html::a('Go to English', str_replace('/ru/', '/en/', Url::to()));
} elseif (Yii::$app->language == 'en') {
    echo Html::a('Перейти на русский', str_replace('/en/', '/ru/', Url::to()));
}