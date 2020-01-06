<?php

namespace common\models\auth\item;

/**
 * This is the ActiveQuery class for [[\common\models\auth\Item]].
 *
 * @see \common\models\auth\Item
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\auth\Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\auth\Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
