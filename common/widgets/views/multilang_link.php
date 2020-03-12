<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = substr(Url::to(), 6);
if (Yii::$app->language == 'ru') {
    echo Html::a('Go to English', '/en-us' . $url);
} elseif (Yii::$app->language == 'en') {
    echo Html::a('Перейти на русский', '/ru-ru' . $url);
}