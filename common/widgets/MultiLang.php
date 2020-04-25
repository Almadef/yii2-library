<?php

namespace common\widgets;

use Yii;
use \yii\bootstrap\Widget;

class MultiLang extends Widget
{

    public function run()
    {
        $nowLanguage = Yii::$app->language;
        $nowUrl = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
        if (!empty(Yii::$app->request->get())) {
            $nowUrl .= '?';
            foreach (Yii::$app->request->get() as $key => $value) {
                $nowUrl .= $key . '=' . $value . '&';
            }
            $nowUrl = substr($nowUrl,0,-1);
        }
        return $this->render('multilang_link', ['nowLanguage' => $nowLanguage, 'nowUrl' => $nowUrl]);
    }
}
