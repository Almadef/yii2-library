<?php

use common\helpers\LanguagesHelper;
use common\helpers\StorageHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\DateHelper;
use \yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $authorDataProvider yii\data\ActiveDataProvider */
/* @var $categoryDataProvider yii\data\ActiveDataProvider */
/* @var $fileDataProvider yii\data\ActiveDataProvider */

$this->title = $model->getTitle();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title_ru',
            'title_en',
            [
                'attribute' => 'publisher_id',
                'value' => function ($model) {
                    return $model->publisher->name;
                },
                'label' => Yii::t('app', 'Publisher'),
            ],
            'release',
            'isbn',
            'pages',
            'description_ru:ntext',
            'description_en:ntext',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return DateHelper::convertUnixToDatetime($model->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return DateHelper::convertUnixToDatetime($model->updated_at);
                },
            ],
        ],
    ]) ?>

    <h4><?= Yii::t('app', 'Authors') ?></h4>
    <?= GridView::widget([
        'dataProvider' => $authorDataProvider,
        'columns' => [
            'id',
            LanguagesHelper::getCurrentAttribute('name'),
            LanguagesHelper::getCurrentAttribute('surname'),
            LanguagesHelper::getCurrentAttribute('patronymic'),
        ],
    ]); ?>

    <h4><?= Yii::t('app', 'Categories') ?></h4>
    <?= GridView::widget([
        'dataProvider' => $categoryDataProvider,
        'columns' => [
            'id',
            LanguagesHelper::getCurrentAttribute('title'),
        ],
    ]); ?>

    <h4><?= Yii::t('app', 'Files') ?></h4>
    <?= GridView::widget([
        'dataProvider' => $fileDataProvider,
        'columns' => [
            'id',
            'file_name',
            [
                'attribute' => 'description',
                'value' => function ($model) {
                    return StorageHelper::convertDescriptionToLabel($model->description);
                },
            ],
            'file_type',
            'file_size',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{document}',
                'buttons' => [
                    'document' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-file" aria-hidden="true"></i>',
                            Yii::$app->storage->getUrl($model->description, $model->file_path),
                            ['title' => Yii::t('app', 'Watch file'), 'target' => '_blank']);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
