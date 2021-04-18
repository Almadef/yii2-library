<?php

namespace common\models\auth;

use common\models\auth\item_child\Query;
use common\models\auth\item_child\Relations;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%auth_item_child}}".
 *
 * @property string $parent
 * @property string $child
 * @property Item $parent0
 * @property Item $child0
 */
final class ItemChild extends ActiveRecord
{
    use Relations;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item_child}}';
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
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child']],
            [
                ['parent'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Item::class,
                'targetAttribute' => ['parent' => 'name']
            ],
            [
                ['child'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Item::class,
                'targetAttribute' => ['child' => 'name']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent' => Yii::t('app', 'Parent'),
            'child' => Yii::t('app', 'Child'),
        ];
    }
}
