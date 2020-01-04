<?php

namespace common\models\book;

use common\models\Author;
use common\models\BookAuthor;
use common\models\BookCategory;
use common\models\Category;
use common\models\Publisher;

/**
 * Trait Relations
 * @package common\models\book
 */
trait Relations
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id'])->andWhere(['is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable(BookCategory::tableName(), ['book_id' => 'id'])->andWhere(['is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'author_id'])
            ->viaTable(BookAuthor::tableName(), ['book_id' => 'id'])->andWhere(['is_deleted' => false]);
    }
}