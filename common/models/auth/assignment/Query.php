<?php

namespace common\models\auth\assignment;

use common\models\auth\Assignment;

/**
 * This is the ActiveQuery class for [[\common\models\auth\Assignment]].
 *
 * @see \common\models\auth\Assignment
 */
final class Query extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Assignment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Assignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
