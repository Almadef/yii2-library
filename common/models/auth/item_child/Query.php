<?php

namespace common\models\auth\item_child;

use common\models\auth\ItemChild;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\auth\ItemChild]].
 *
 * @see \common\models\auth\ItemChild
 */
final class Query extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return ItemChild[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ItemChild|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
