<?php

namespace common\models\user_book;

use common\models\UserBook;

/**
 * This is the ActiveQuery class for [[\common\models\UserBook]].
 *
 * @see \common\models\UserBook
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserBook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserBook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    /**
     * @param $bookId
     * @return Query
     */
    public function byBookId($bookId)
    {
        return $this->andWhere(['{{%user_book}}.book_id' => $bookId]);
    }
    /**
     * @param $userId
     * @return Query
     */
    public function byUserId($userId)
    {
        return $this->andWhere(['{{%user_book}}.user_id' => $userId]);
    }
}
