<?php

namespace common\models\storage;

use common\models\interfaces\QuerySafeDeleteInterface;

/**
 * This is the ActiveQuery class for [[\common\models\storage\ActiveRecord]].
 *
 * @see \common\models\storage\ActiveRecord
 */
final class Query extends \yii\db\ActiveQuery implements QuerySafeDeleteInterface
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
     * {@inheritdoc}
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['is_deleted' => false]);
    }
}
