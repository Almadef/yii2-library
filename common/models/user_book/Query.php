<?php

namespace common\models\user_book;

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
     * @return \common\models\UserBook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\UserBook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
