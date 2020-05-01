<?php

namespace frontend\controllers;

use common\api\Controller;
use common\models\UserBook;
use Yii;
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
        $book_id = Yii::$app->request->post('book_id');
        $user_id = Yii::$app->user->id;

        $isFavorite = UserBook::find()
            ->byBookId($book_id)
            ->byUserId($user_id)
            ->exists();

        if ($isFavorite) {
            return $this->getErrorResponse('Book is favorite');
        } else {
            $userBook = new UserBook();
            $userBook->book_id = $book_id;
            $userBook->user_id = $user_id;
            $userBook->save();

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
        $book_id = Yii::$app->request->post('book_id');

        $favorite = UserBook::find()
            ->byBookId($book_id)
            ->byUserId(Yii::$app->user->id)
            ->one();

        if (!isset($isFavorite)) {
            $favorite->delete();
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
