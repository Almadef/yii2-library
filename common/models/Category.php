<?php

namespace common\models;

use common\helpers\LanguagesHelper;
use common\models\category\Query;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_ru', 'title_en'], 'required'],
            [['title_ru', 'title_en'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'integer'],
            [['is_deleted'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => Yii::t('app', 'Title (ru)'),
            'title_en' => Yii::t('app', 'Title (en)'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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

    /**
     * @return array
     */
    public static function getForSelector(): array
    {
        return ArrayHelper::map(
            self::find()->isNoDeleted()->all(), 'id', LanguagesHelper::getCurrentAttribute('title')
        );
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        $title = LanguagesHelper::getCurrentAttribute('title');
        return $this->$title;
    }
}
