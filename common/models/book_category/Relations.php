<?php

namespace common\models\book_category;

use common\models\Book;
use common\models\Category;

/**
 * Trait Relations
 * @package common\models\book
 */
trait Relations
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}