<?php

namespace common\models\auth;

use common\models\auth\item\Query;
use common\models\auth\item\Relations;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property string|null $rule_name
 * @property resource|null $data
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property Assignment[] $authAssignments
 * @property Rule $ruleName
 * @property ItemChild[] $authItemChildren
 * @property ItemChild[] $authItemChildren0
 * @property Item[] $children
 * @property Item[] $parents
 */
final class Item extends ActiveRecord
{
    use Relations;

    public const TYPE_ROLE = 1;
    public const TYPE_PERMISSION = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * {@inheritdoc}
     *
     * @return Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Query(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [
                ['rule_name'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Rule::class,
                'targetAttribute' => ['rule_name' => 'name']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
