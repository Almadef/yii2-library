<?php

namespace common\models;

use common\models\storage\Query;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%storage}}".
 *
 * @property int $id
 * @property int $model_id
 * @property string $model_name
 * @property string $description
 * @property string $file_name
 * @property string $file_type
 * @property int $file_size
 * @property string $file_path
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
class Storage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%storage}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'model_name', 'description', 'file_name', 'file_type', 'file_size', 'file_path'], 'required'],
            [['model_id', 'file_size', 'created_at', 'updated_at', 'is_deleted'], 'integer'],
            [['model_name', 'description', 'file_name', 'file_type', 'file_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'model_name' => Yii::t('app', 'Model Name'),
            'description' => Yii::t('app', 'Description'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_type' => Yii::t('app', 'File Type'),
            'file_size' => Yii::t('app', 'File Size'),
            'file_path' => Yii::t('app', 'File Path'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
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
}
