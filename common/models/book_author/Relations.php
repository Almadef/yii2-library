<?php

namespace common\models\book_author;

use common\models\Author;
use common\models\Book;

/**
 * Trait Relations
 * @package common\models\book
 */
trait Relations
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }
}