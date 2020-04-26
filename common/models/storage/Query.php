<?php

namespace common\models\storage;

use common\models\Storage;

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
     * @return Storage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Storage|array|null
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
