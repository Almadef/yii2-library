<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $title
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
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
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
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\category\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\category\Query(get_called_class());
    }

    /**
     * @return array
     */
    public static function getForSelector():array
    {
        return ArrayHelper::map(
            self::find()->isNoDeleted()->all(), 'id', 'title'
        );
    }
}
