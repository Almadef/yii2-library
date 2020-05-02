<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SaveUserForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $selectRole array */
/* @var $selectStatus array */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'status')->widget(Select2::class, [
        'data' => $selectStatus,
        'options' => [
            'placeholder' => Yii::t('app', 'Select...'),
        ],
    ]) ?>

    <?= $form->field($model, 'role_name')->widget(Select2::class, [
        'data' => $selectRole,
        'options' => [
            'placeholder' => Yii::t('app', 'Select...'),
            $model->role_name => ['Selected' => true]
        ],
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
