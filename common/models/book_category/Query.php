<?php

namespace common\models\book_category;

/**
 * This is the ActiveQuery class for [[\common\models\BookCategory]].
 *
 * @see \common\models\BookCategory
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\BookCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\BookCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
