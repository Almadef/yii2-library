<?php

namespace common\models\auth\item;

use common\models\auth\Item;

/**
 * This is the ActiveQuery class for [[\common\models\auth\Item]].
 *
 * @see \common\models\auth\Item
 */
final class Query extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byType($type)
    {
        return $this->andWhere(['type' => $type]);
    }

    public function byName($name)
    {
        return $this->andWhere(['name' => $name]);
    }
}
