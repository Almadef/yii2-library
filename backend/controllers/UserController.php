<?php

namespace backend\controllers;

use backend\actions\DeleteAction;
use backend\actions\ViewAction;
use backend\controllers\interfaces\MergeBaseActionInterface;
use backend\controllers\traits\CacheManagementTraits;
use backend\models\SaveUserForm;
use common\helpers\RoleHelper;
use common\models\User;
use Yii;
use common\models\user\Search;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
final class UserController extends Controller implements MergeBaseActionInterface
{
    use CacheManagementTraits;

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $selectRole = RoleHelper::getForSelector();
        $selectStatus = User::getStatusForSelector();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'selectRole' => $selectRole,
            'selectStatus' => $selectStatus,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new SaveUserForm(['scenario' => 'create']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $selectRole = RoleHelper::getForSelector();
        $selectStatus = User::getStatusForSelector();

        return $this->render('create', [
            'model' => $model,
            'selectRole' => $selectRole,
            'selectStatus' => $selectStatus,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($model->role)) {
            $model->role_name = $model->role->item_name;
        } else {
            $model->role_name = RoleHelper::ROLE_USER;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $selectRole = RoleHelper::getForSelector();
        $selectStatus = User::getStatusForSelector();

        return $this->render('update', [
            'model' => $model,
            'selectRole' => $selectRole,
            'selectStatus' => $selectStatus,
        ]);
    }

    /**
     * @return array
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'view' => ViewAction::class,
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
        return User::class;
    }

    /**
     * @param $id
     * @return SaveUserForm|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = SaveUserForm::findOne($id)) !== null) {
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
                        'roles' => ['viewUser'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewUser'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createUser'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateUser'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteUser'],
                    ],
                ],
            ],
        ];
    }
}
