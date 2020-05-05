<?php

namespace common\models\book_category;

/**
 * This is the ActiveQuery class for [[\common\models\book_category\ActiveRecord]].
 *
 * @see \common\models\ActiveRecord
 */
final class Query extends \yii\db\ActiveQuery
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
}
