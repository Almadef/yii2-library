<?php

use yii\helpers\Html;
use yii\helpers\Url;

$url = substr(Url::to(), 3);
if (Yii::$app->language == 'ru') {
    echo Html::a('Go to English', '/en' . $url);
} elseif (Yii::$app->language == 'en') {
    echo Html::a('Перейти на русский', '/ru' . $url);
}