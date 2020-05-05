<?php

namespace common\models\user_book;

/**
 * This is the ActiveQuery class for [[\common\models\user_book\ActiveRecord]].
 *
 * @see \common\models\user_book\ActiveRecord
 */
final class Query extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return ActiveRecord[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ActiveRecord|array|null
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
