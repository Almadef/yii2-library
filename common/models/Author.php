<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%author}}".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%author}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'patronymic' => Yii::t('app', 'Patronymic'),
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
     * @return \common\models\author\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\author\Query(get_called_class());
    }

    /**
     * @return array
     */
    public static function getForSelector(): array
    {
        return ArrayHelper::map(
            self::find()->isNoDeleted()->all(), 'id', function ($model) {
            return $model->getFullName();
        },
            );
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->surname . ' ' . $this->name . ' ' . (isset($this->patronymic) ? $this->patronymic : '');
    }
}
