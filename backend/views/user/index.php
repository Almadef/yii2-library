<?php

use common\helpers\RoleHelper;
use common\helpers\UserHelper;
use yii\grid\GridView;
use yii\helpers\Html;

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

    <?= GridView::widget(
    [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'username',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        /**
                         * @var $model \common\models\user\Search
                         */
                        return UserHelper::getStatusName($model->status);
                    },
                    'filter' => $selectStatus,
                ],
                [
                    'value' => function ($model) {
                        /**
                         * @var $model \common\models\user\Search
                         */
                        if (isset($model->role)) {
                            $roleName = RoleHelper::getRoleName($model->role->item_name);
                        } else {
                            $roleName = RoleHelper::getRoleName(RoleHelper::ROLE_USER);
                        }

                        return $roleName;
                    },
                    'label' => Yii::t('app', 'Role'),
                    'filter' => $selectRole,
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]
); ?>


</div>
