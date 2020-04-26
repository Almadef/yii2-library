<?php

namespace common\models\category;

use common\models\Category;

/**
 * This is the ActiveQuery class for [[\common\models\Category]].
 *
 * @see \common\models\Category
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return Query
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['is_deleted' => false]);
    }
}
