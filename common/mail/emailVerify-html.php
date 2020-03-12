<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Url::to(['@frontend/site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to verify your email:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
