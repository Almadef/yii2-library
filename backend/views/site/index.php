<?php

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Home');
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php if (\Yii::$app->user->can('viewBook')) : ?>
            <div class="col-lg-4 link">
                <a href="/book" class="a-no-decoration" style="text-decoration: none;">
                <div class="panel panel-primary panel-main">
                    <div class="panel-heading panel-heading-main">
                        <?= Yii::t('app', 'Books') ?>
                    </div>
                    <div class="panel-body">
                        <i class="glyphicon glyphicon-book glyphicon-main" aria-hidden="true"></i>
                    </div>
                </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('viewAuthor')) : ?>
            <div class="col-lg-4 link">
                <a href="/author" class="a-no-decoration" style="text-decoration: none;">
                    <div class="panel panel-primary panel-main">
                        <div class="panel-heading panel-heading-main">
                            <?= Yii::t('app', 'Authors') ?>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-pencil glyphicon-main" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('viewCategory')) : ?>
            <div class="col-lg-4 link">
                <a href="/category" class="a-no-decoration" style="text-decoration: none;">
                    <div class="panel panel-primary panel-main">
                        <div class="panel-heading panel-heading-main">
                            <?= Yii::t('app', 'Categories') ?>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-tags glyphicon-main" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('viewPublisher')) : ?>
            <div class="col-lg-4 link">
                <a href="/publisher" class="a-no-decoration" style="text-decoration: none;">
                    <div class="panel panel-primary panel-main">
                        <div class="panel-heading panel-heading-main">
                            <?= Yii::t('app', 'Publishers') ?>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-print glyphicon-main" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('viewUser')) : ?>
            <div class="col-lg-4 link">
                <a href="/user" class="a-no-decoration" style="text-decoration: none;">
                    <div class="panel panel-primary panel-main">
                        <div class="panel-heading panel-heading-main">
                            <?= Yii::t('app', 'Users') ?>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-user glyphicon-main" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
