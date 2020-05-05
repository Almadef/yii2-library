<?php

namespace common\models\book_category;

use common\models\Book;
use common\models\Category;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%book_category}}".
 *
 * @property int $book_id
 * @property int $category_id
 * @property int $created_at
 *
 * @property Book $book
 * @property Category $category
 */
abstract class ActiveRecord extends \yii\db\ActiveRecord
{
    use Relations;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'category_id'], 'required'],
            [['book_id', 'category_id', 'created_at'], 'integer'],
            [['book_id', 'category_id'], 'unique', 'targetAttribute' => ['book_id', 'category_id']],
            [
                ['book_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Book::class,
                'targetAttribute' => ['book_id' => 'id']
            ],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::class,
                'targetAttribute' => ['category_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
            ],
            'value' => time(),
        ];
    }

    /**
     * {@inheritdoc}
     * @return Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Query(get_called_class());
    }
}
