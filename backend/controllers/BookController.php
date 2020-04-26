<?php

namespace backend\controllers;

use backend\actions\DeleteAction;
use common\models\Author;
use common\models\Category;
use common\models\Publisher;
use common\models\Storage;
use Yii;
use common\models\Book;
use common\models\book\Search;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Book model.
 */
final class BookController extends Controller
{
    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $selectPublisher = Publisher::getForSelector();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'selectPublisher' => $selectPublisher,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $authorDataProvider = new ActiveDataProvider([
            'query' => $model->getAuthors(),
        ]);
        $categoryDataProvider = new ActiveDataProvider([
            'query' => $model->getCategories(),
        ]);
        $fileDataProvider = new ActiveDataProvider([
            'query' => $model->getFiles(),
        ]);

        return $this->render('view', [
            'model' => $model,
            'authorDataProvider' => $authorDataProvider,
            'categoryDataProvider' => $categoryDataProvider,
            'fileDataProvider' => $fileDataProvider,
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $selectCategory = Category::getForSelector();
        $selectAuthor = Author::getForSelector();
        $selectPublisher = Publisher::getForSelector();

        return $this->render('create', [
            'model' => $model,
            'selectCategory' => $selectCategory,
            'selectAuthor' => $selectAuthor,
            'selectPublisher' => $selectPublisher,
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param int|null $fileDeleteId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdate($id, $fileDeleteId = null)
    {
        $model = $this->findModel($id);

        if ($fileDeleteId) {
            $this->findFileModel($fileDeleteId)->delete();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $selectCategory = Category::getForSelector();
        $selectAuthor = Author::getForSelector();
        $selectPublisher = Publisher::getForSelector();

        return $this->render('update', [
            'model' => $model,
            'selectCategory' => $selectCategory,
            'selectAuthor' => $selectAuthor,
            'selectPublisher' => $selectPublisher,
        ]);
    }

    /**
     * @return array
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'delete' => DeleteAction::class,
        ]);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Storage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Storage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findFileModel($id)
    {
        if (($model = Storage::findOne($id)) !== null) {
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
                        'roles' => ['viewBook'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewBook'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createBook'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateBook'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteBook'],
                    ],
                ],
            ],
        ];
    }
}
