<?php

namespace frontend\controllers;

use common\api\Controller;
use common\models\UserBook;
use Yii;
use yii\caching\TagDependency;
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

        $isFavorite = UserBook::find()
            ->byBookId($bookId)
            ->byUserId($userId)
            ->exists();

        if ($isFavorite) {
            return $this->getErrorResponse('Book is favorite');
        } else {
            $userBook = new UserBook();
            $userBook->book_id = $bookId;
            $userBook->user_id = $userId;
            $userBook->save();

            TagDependency::invalidate(Yii::$app->cache, ['library_favourites_' . $userId]);

            $this->addToResponseData(Yii::t('app', 'Delete from favorites'), 'textBtn');
            return $this->getSuccessResponse();
        }
    }

    /**
     * @return json
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDel()
    {
        $bookId = Yii::$app->request->post('book_id');
        $userId = Yii::$app->user->id;

        $favorite = UserBook::find()
            ->byBookId($bookId)
            ->byUserId($userId)
            ->one();

        if (!isset($isFavorite)) {
            $favorite->delete();

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
