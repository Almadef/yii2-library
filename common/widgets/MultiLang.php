<?php

namespace common\widgets;

use Yii;
use yii\helpers\Html;

class MultiLang extends \yii\bootstrap\Widget
{

    public function run()
    {
        if(\Yii::$app->language == 'ru'):
            echo Html::a('Go to English', array_merge(
                \Yii::$app->request->get(),
                [\Yii::$app->controller->route, 'language' => 'en']
            ));
        else:
            echo Html::a('Перейти на русский', array_merge(
                \Yii::$app->request->get(),
                [\Yii::$app->controller->route, 'language' => 'ru']
            ));
        endif;
    }
}
