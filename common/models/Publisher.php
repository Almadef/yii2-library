<?php

namespace common\models;

use common\models\publisher\Relations;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%publisher}}".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Book[] $books
 */
class Publisher extends \yii\db\ActiveRecord
{
    use Relations;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%publisher}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\publisher\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\publisher\Query(get_called_class());
    }

    /**
     * @return array
     */
    public static function getForSelector():array
    {
        return ArrayHelper::map(
            self::find()->all(), 'id', 'name'
        );
    }
}
