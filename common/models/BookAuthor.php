<?php

namespace common\models;

use common\models\book_author\Relations;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%book_author}}".
 *
 * @property int $book_id
 * @property int $author_id
 * @property int $created_at
 *
 * @property Author $author
 * @property Book $book
 */
class BookAuthor extends \yii\db\ActiveRecord
{
    use Relations;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book_author}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id', 'created_at'], 'integer'],
            [['book_id', 'author_id'], 'unique', 'targetAttribute' => ['book_id', 'author_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'author_id' => 'Author ID',
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
     * @return \common\models\book_author\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\book_author\Query(get_called_class());
    }
}
