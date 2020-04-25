<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $categories \common\models\Category[] */
?>
<h3 class="text-center"><?= Yii::t('app', 'Categories') ?></h3>
<div class="btn-group-vertical btn-full-width" role="group" aria-label="<?= Yii::t('app', 'Categories') ?>">
    <?php foreach ($categories as $category): ?>
        <?= Html::a($category->title,
            Url::to(['library/index', 'category_id' => $category->id]),
            ['title' => $category->title, 'class' => 'btn btn-default']) ?>
    <?php endforeach; ?>
</div>