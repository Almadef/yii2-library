<?php

namespace common\models\storage;

/**
 * This is the ActiveQuery class for [[\common\models\Storage]].
 *
 * @see \common\models\Storage
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Storage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Storage|array|null
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
