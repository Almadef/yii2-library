<?php

namespace common\models\publisher;

use common\models\interfaces\QuerySafeDeleteInterface;

/**
 * This is the ActiveQuery class for [[\common\models\publisher\ActiveRecord]].
 *
 * @see \common\models\Publisher
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
        return $this->andWhere(['{{%publisher}}.is_deleted' => false]);
    }
}
