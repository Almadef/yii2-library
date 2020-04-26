<?php

namespace common\models\auth\rule;

use common\models\auth\Rule;

/**
 * This is the ActiveQuery class for [[\common\models\auth\Rule]].
 *
 * @see \common\models\auth\Rule
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Rule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Rule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
