<?php

namespace backend\controllers;

use backend\actions\CreateAction;
use backend\actions\DeleteAction;
use backend\actions\IndexAction;
use backend\actions\UpdateAction;
use backend\actions\ViewAction;
use Yii;
use common\models\Author;
use common\models\author\Search;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorController implements the CRUD actions for Author model.
 */
final class AuthorController extends Controller
{
    use CacheManagement;
    
    /**
     * @return array
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => IndexAction::class,
            'view' => ViewAction::class,
            'create' => CreateAction::class,
            'update' => UpdateAction::class,
            'delete' => DeleteAction::class,
        ]);
    }

    /**
     * @return Search
     */
    public function getSearchModel()
    {
        return new Search();
    }

    /**
     * @return string
     */
    public function getModelClass()
    {
        return Author::class;
    }

    /**
     * @return array
     */
    public function getCacheTags()
    {
        return ['library_index'];
    }

    /**
     * @param $id
     * @return Author|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Author::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('error', 'The requested page does not exist.'));
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['viewAuthor'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewAuthor'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createAuthor'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateAuthor'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteAuthor'],
                    ],
                ],
            ],
        ];
    }
}
