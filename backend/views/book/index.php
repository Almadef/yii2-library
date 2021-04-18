<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\book\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $selectPublisher array */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget(
    [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'title_ru',
                'title_en',
                [
                    'attribute' => 'publisher_id',
                    'value' => 'publisher.name',
                    'label' => Yii::t('app', 'Publisher'),
                    'filter' => $selectPublisher,
                ],
                'isbn',
                'release',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
); ?>


</div>
