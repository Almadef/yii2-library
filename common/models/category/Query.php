<?php

namespace common\models\category;

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
     * @return \common\models\Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Category|array|null
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
