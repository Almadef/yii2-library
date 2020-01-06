<?php

namespace common\models\auth\rule;

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
     * @return \common\models\auth\Rule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\auth\Rule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
