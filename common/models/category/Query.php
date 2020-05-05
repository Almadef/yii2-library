<?php

namespace common\models\category;

use common\models\Category;
use common\models\interfaces\QuerySafeDeleteInterface;

/**
 * This is the ActiveQuery class for [[\common\models\category\ActiveRecord]].
 *
 * @see \common\models\Category
 */
final class Query extends \yii\db\ActiveQuery implements QuerySafeDeleteInterface
{
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
     * {@inheritdoc}
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['{{%category}}.is_deleted' => false]);
    }
}
