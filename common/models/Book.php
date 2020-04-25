<?php

namespace common\models;

use common\behavior\StorageBehavior;
use common\helpers\StorageHelper;
use common\models\book\Relations;
use voskobovich\behaviors\ManyToManyBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
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
 * @property Storage $fileCover
 * @property Storage $fileBook
 * @property Category[] $categories
 * @property Author[] $authors
 * @property Storage[] $files
 */
class Book extends \yii\db\ActiveRecord
{
    use Relations;

    /**
     * @var string
     */
    const FILE_COVER_EXTENSIONS = 'png, jpg, jpeg';
    /**
     * @var string
     */
    const FILE_MAX_SIZE = 12 * 1024 * 1024;

    /**
     * @var UploadedFile
     */
    public $coverFile;

    /**
     * @var UploadedFile
     */
    public $bookFile;

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
            [
                ['publisher_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Publisher::class,
                'targetAttribute' => ['publisher_id' => 'id']
            ],
            [['category_ids'], 'each', 'rule' => ['integer']],
            [['author_ids'], 'each', 'rule' => ['integer']],
            [
                ['coverFile'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => self::FILE_COVER_EXTENSIONS,
                'maxFiles' => 1,
                'maxSize' => self::FILE_MAX_SIZE
            ],
            [['bookFile'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 1, 'maxSize' => self::FILE_MAX_SIZE],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'title' => Yii::t('app', 'Title'),
            'release' => Yii::t('app', 'Release date'),
            'isbn' => Yii::t('app', 'ISBN code'),
            'pages' => Yii::t('app', 'Call pages'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'coverFile' => Yii::t('app', 'Cover File'),
            'bookFile' => Yii::t('app', 'Book File'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true
            ],
            [
                'class' => ManyToManyBehavior::class,
                'relations' => [
                    'category_ids' => [
                        'categories',
                        'viaTableValues' => [
                            'created_at' => function () {
                                return time();
                            },
                        ],
                    ],
                    'author_ids' => [
                        'authors',
                        'viaTableValues' => [
                            'created_at' => function () {
                                return time();
                            },
                        ],
                    ],
                ],
            ],
            [
                'class' => StorageBehavior::class,
                'attributes' => [
                    [
                        'name' => 'coverFile',
                        'description' => StorageHelper::BOOK_COVER_DESCRIPTION
                    ],
                    [
                        'name' => 'bookFile',
                        'description' => StorageHelper::BOOK_BOOK_DESCRIPTION
                    ],
                ]
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

    /**
     * @return string
     */
    public function getAuthorsString(): string
    {
        $authors = $this->authors;
        $return = '';
        foreach ($authors as $author) {
            $return .= $author->getFullName() . ', ';
        }
        if ($return !== '') {
            $return = mb_substr($return, 0, -2);
        }
        return $return;
    }

    /**
     * @return string
     */
    public function getAuthorsStringLink(): string
    {
        $authors = $this->authors;
        $return = '';
        foreach ($authors as $author) {
            $return .= Html::a($author->getFullName(), Url::to(['library/index', 'author_id' => $author->id])) . ', ';
        }
        if ($return !== '') {
            $return = mb_substr($return, 0, -2);
        }
        return $return;
    }

    /**
     * @return string
     */
    public function getCategoriesStringLink(): string
    {
        $categories = $this->categories;
        $return = '';
        foreach ($categories as $category) {
            $return .= Html::a($category->title, Url::to(['library/index', 'category_id' => $category->id])) . ', ';
        }
        if ($return !== '') {
            $return = mb_substr($return, 0, -2);
        }
        return $return;
    }
}
