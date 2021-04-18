<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\author\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Authors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Author'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget(
    [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'name_ru',
                'name_en',
                'surname_ru',
                'surname_en',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
); ?>


</div>
