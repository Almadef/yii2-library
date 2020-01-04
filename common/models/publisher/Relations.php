<?php

namespace common\models\publisher;

use common\models\Book;

/**
 * Trait Relations
 * @package common\models\publisher
 */
trait Relations
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['publisher_id' => 'id'])->andWhere(['is_deleted' => false]);
    }
}