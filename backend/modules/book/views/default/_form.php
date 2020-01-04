<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\Url;

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

    <?= $form->field($model, 'publisher_id')->dropDownList($selectPublisher, array('prompt' => Yii::t('app', 'Select...')))->label(Yii::t('app', 'Publisher')) ?>

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
    )->label(Yii::t('app', 'Categories')) ?>

    <?= $form->field($model, 'author_ids')->dropDownList(
        $selectAuthor,
        [
            'multiple' => 'multiple',
            'size' => 5,
        ]
    )->label(Yii::t('app', 'Authors')) ?>

    <?php
    if(!isset($model->fileCover)) {
        echo $form->field($model, 'coverFile')->fileInput();
    } else {
        $url = Url::toRoute(['update', 'id' => $model->id, 'fileDeleteId' => $model->fileCover->id]);
        echo '<p>' . Html::a(Yii::t('app', 'Deleted cover'),
                $url) . ' ' . Html::a(Yii::t('app', 'Watch file'),
                Yii::$app->storage->getUrl($model->fileCover->description, $model->fileCover->file_path),
                ['target' => '_blank']) . '</p>';
    }
    ?>

    <?php
    if(!isset($model->fileBook)) {
        echo $form->field($model, 'bookFile')->fileInput();
    } else {
        $url = Url::toRoute(['update', 'id' => $model->id, 'fileDeleteId' => $model->fileBook->id]);
        echo '<p>' . Html::a(Yii::t('app', 'Deleted book'),
                $url) . ' ' . Html::a(Yii::t('app', 'Watch file'),
                Yii::$app->storage->getUrl($model->fileBook->description, $model->fileBook->file_path),
                ['target' => '_blank']) . '</p>';
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
