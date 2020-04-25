<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $selectRole array */
/* @var $selectStatus array */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($selectStatus, [
        'prompt' => Yii::t('app', 'Select...')
    ]) ?>

    <?= $form->field($model, 'role_name')->dropDownList($selectRole, [
        'prompt' => Yii::t('app', 'Select...'),
        'options' => [$model->role->item_name => ['Selected' => true]]
    ])->label(Yii::t('app', 'Role')) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
