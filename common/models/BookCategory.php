<?php

namespace common\models;

use common\models\book_category\Relations;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
class BookCategory extends \yii\db\ActiveRecord
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
                'targetClass' => Book::className(),
                'targetAttribute' => ['book_id' => 'id']
            ],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::className(),
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
            TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
            ],
            'value' => time(),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\book_category\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\book_category\Query(get_called_class());
    }
}
