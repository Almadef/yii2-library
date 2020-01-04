<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $selectCategory array */
/* @var $selectAuthor array */
/* @var $selectPublisher array */

$this->title = 'Create Book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'selectCategory' => $selectCategory,
        'selectAuthor' => $selectAuthor,
        'selectPublisher' => $selectPublisher,
    ]) ?>

</div>
