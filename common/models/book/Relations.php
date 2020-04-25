<?php

namespace common\models\book;

use common\helpers\StorageHelper;
use common\models\Author;
use common\models\Book;
use common\models\BookAuthor;
use common\models\BookCategory;
use common\models\Category;
use common\models\Publisher;
use common\models\Storage;

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
        return $this->hasOne(Publisher::class,
            ['id' => 'publisher_id'])->andWhere(['{{%publisher}}.is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable(BookCategory::tableName(), ['book_id' => 'id'])->andWhere(['{{%category}}.is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(BookAuthor::tableName(), ['book_id' => 'id'])->andWhere(['{{%author}}.is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Storage::class, ['model_id' => 'id'])
            ->andWhere(['model_name' => Book::class])
            ->andWhere(['is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileCover()
    {
        return $this->hasOne(Storage::class, ['model_id' => 'id'])
            ->andWhere(['model_name' => Book::class])
            ->andWhere(['description' => StorageHelper::BOOK_COVER_DESCRIPTION])
            ->andWhere(['is_deleted' => false]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileBook()
    {
        return $this->hasOne(Storage::class, ['model_id' => 'id'])
            ->andWhere(['model_name' => Book::class])
            ->andWhere(['description' => StorageHelper::BOOK_BOOK_DESCRIPTION])
            ->andWhere(['is_deleted' => false]);
    }
}