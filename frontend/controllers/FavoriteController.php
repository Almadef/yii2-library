<?php

namespace frontend\controllers;

use common\api\Controller;
use common\models\Book;
use common\models\User;
use Throwable;
use Yii;
use yii\caching\TagDependency;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * FavoriteController controller
 */
final class FavoriteController extends Controller
{
    /**
     * @return json
     */
    public function actionAdd()
    {
        $bookId = Yii::$app->request->post('book_id');
        $userId = Yii::$app->user->id;

        $book = Book::findOne($bookId);
        if (!isset($book)) {
            return $this->getErrorResponse('Book no find');
        }

        $user = User::findOne($userId);

        $userBook = $user->getBooks()
            ->andWhere(['{{%book}}.id' => $bookId])
            ->one();

        if (isset($userBook)) {
            return $this->getErrorResponse('Book is favorite');
        } else {
            $user->link('books', $book);

            TagDependency::invalidate(Yii::$app->cache, ['library_favourites_' . $userId]);

            $this->addToResponseData(Yii::t('app', 'Delete from favorites'), 'textBtn');
            return $this->getSuccessResponse();
        }
    }

    /**
     * @return json
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDel()
    {
        $bookId = Yii::$app->request->post('book_id');
        $userId = Yii::$app->user->id;

        $book = Book::findOne($bookId);
        if (!isset($book)) {
            return $this->getErrorResponse('Book no find');
        }

        $user = User::findOne($userId);

        $userBook = $user->getBooks()
            ->andWhere(['{{%book}}.id' => $bookId])
            ->one();

        if (isset($userBook)) {
            $user->unlink('books', $book, true);

            TagDependency::invalidate(Yii::$app->cache, ['library_favourites_' . $userId]);

            $this->addToResponseData(Yii::t('app', 'Add to favorites'), 'textBtn');
            return $this->getSuccessResponse();
        } else {
            return $this->getErrorResponse('Book is not favorite');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add', 'del'],
                'rules' => [
                    [
                        'actions' => ['add', 'del'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add' => ['post'],
                    'del' => ['post'],
                ],
            ],
        ];
    }
}
