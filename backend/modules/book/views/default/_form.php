<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
/* @var $selectCategory array */
/* @var $selectAuthor array */
/* @var $selectPublisher array */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher_id')->dropDownList($selectPublisher, array('prompt' => 'Выбрать...')); ?>

    <?= $form->field($model, 'release')->textInput() ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pages')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_ids')->dropDownList(
        $selectCategory,
        [
            'multiple' => 'multiple',
            'size' => 5,
        ]
    ); ?>

    <?= $form->field($model, 'author_ids')->dropDownList(
        $selectAuthor,
        [
            'multiple' => 'multiple',
            'size' => 5,
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
