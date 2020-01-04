<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\book\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $selectPublisher array */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'publisher_id',
                'value' => 'publisher.name',
                'label' => 'Publisher',
                'filter' => $selectPublisher,
            ],
            'release',
            'isbn',
            'pages',
            //'description:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
