<?php

namespace common\models\author;

use common\models\Author;

/**
 * This is the ActiveQuery class for [[\common\models\Author]].
 *
 * @see \common\models\Author
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Author[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Author|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return Query
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['is_deleted' => false]);
    }
}
