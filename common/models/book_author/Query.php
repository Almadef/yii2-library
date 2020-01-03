<?php

namespace common\models\book_author;

/**
 * This is the ActiveQuery class for [[\common\models\BookAuthor]].
 *
 * @see \common\models\BookAuthor
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BookAuthor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BookAuthor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
