<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%author}}".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property int $created_at
 * @property int $updated_at
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
            [['name', 'surname'], 'unique'],
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
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
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
     * @return \common\models\author\Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\author\Query(get_called_class());
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
