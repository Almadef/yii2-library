<?php

use yii\db\Migration;

/**
 * Class m200102_140150_add_user_role
 */
class m200102_140150_add_user_role extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert(
            '{{%auth_item}}',
            ['name', 'type', 'description', 'created_at', 'updated_at'],
            [
                ['user', 1, 'User role', 1577973888, 1577973888],
            ]
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200102_140150_add_user_role cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200102_140149_add_admin_role cannot be reverted.\n";

        return false;
    }
    */
}
