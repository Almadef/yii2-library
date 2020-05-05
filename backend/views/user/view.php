<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\DateHelper;
use common\helpers\RoleHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    /**
                     * @var $model \common\models\user\Search
                     */
                    return \common\helpers\UserHelper::getStatusName($model->status);
                },
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
            ],
            'password_hash',
            'auth_key',
            'verification_token',
            'password_reset_token',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    /**
                     * @var $model \common\models\user\Search
                     */
                    return DateHelper::convertUnixToDatetime($model->created_at);
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    /**
                     * @var $model \common\models\user\Search
                     */
                    return DateHelper::convertUnixToDatetime($model->updated_at);
                },
            ],
        ],
    ]) ?>

</div>
