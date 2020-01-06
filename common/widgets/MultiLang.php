<?php

namespace common\widgets;

use Yii;
use \yii\bootstrap\Widget;

class MultiLang extends Widget
{

    public function run()
    {
        $nowLanguage = Yii::$app->language;
        return $this->render('multilang_link', ['nowLanguage' => $nowLanguage]);
    }
}
