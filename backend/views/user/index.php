<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\RoleHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\user\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $selectRole array */
/* @var $selectStatus array */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    /**
                     * @var $model \common\models\User
                     */
                    return $model->getStatusName();
                },
                'filter' => $selectStatus,
            ],
            [
                'value' => function ($model) {
                    /**
                     * @var $model \common\models\User
                     */
                    return RoleHelper::getRoleName($model->role->item_name);
                },
                'label' => Yii::t('app', 'Role'),
                'filter' => $selectRole,
            ],
//            'password_hash',
//            'password_reset_token',
//            'created_at',
//            'updated_at',
//            'auth_key',
//            'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
