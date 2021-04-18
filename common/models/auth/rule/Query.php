<?php

namespace common\models\auth\rule;

use common\models\auth\Rule;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\auth\Rule]].
 *
 * @see \common\models\auth\Rule
 */
final class Query extends ActiveQuery
{
    /**
     * {@inheritdoc}
     *
     * @return Rule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     *
     * @return Rule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
