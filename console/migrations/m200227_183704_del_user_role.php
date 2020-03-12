<?php

use yii\db\Migration;
use common\models\auth\Item as AuthItem;

/**
 * Class m200227_183704_del_user_role
 */
class m200227_183704_del_user_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $userRole = AuthItem::find()
            ->byType(AuthItem::TYPE_ROLE)
            ->byName('user')
            ->one();
        $userRole->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}',
            ['name', 'type', 'description', 'created_at', 'updated_at'], [
                ['user', 1, 'User role', 1577973888, 1577973888],
            ])->execute();
    }
}
