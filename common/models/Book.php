<?php

namespace common\models;

use common\models\book\Relations;
use voskobovich\behaviors\ManyToManyBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property int $id
 * @property int $publisher_id
 * @property string $title
 * @property string $release
 * @property string $isbn
 * @property int $pages
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 *
 * @property Publisher $publisher
 * @property array $categories
 * @property array $authors
 */
class Book extends \yii\db\ActiveRecord
{
    use Relations;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publisher_id', 'title', 'release', 'isbn', 'pages'], 'required'],
            [['publisher_id', 'pages', 'created_at', 'updated_at'], 'integer'],
            [['release'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 64],
            [['is_deleted'], 'boolean'],
            [['publisher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publisher::className(), 'targetAttribute' => ['publisher_id' => 'id']],
            [['category_ids'], 'each', 'rule' => ['integer']],
            [['author_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publisher_id' => 'Publisher ID',
            'title' => 'Title',
            'release' => 'Release',
            'isbn' => 'Isbn',
            'pages' => 'Pages',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true
            ],
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => [
                        'categories',
                        'viaTableValues' => [
                            'created_at' => function() {
                                return time();
                            },
                        ],
                    ],
                    'author_ids' => [
                        'authors',
                        'viaTableValues' => [
                            'created_at' => function() {
                                return time();
                            },
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\book\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\book\Query(get_called_class());
    }
}
