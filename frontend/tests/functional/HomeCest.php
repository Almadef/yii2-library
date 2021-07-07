<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(Yii::$app->homeUrl);
        $I->see('yii2-library');
    }
}
