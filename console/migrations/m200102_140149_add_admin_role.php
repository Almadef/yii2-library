<?php

use yii\db\Migration;

/**
 * Class m200102_140149_add_admin_role
 */
class m200102_140149_add_admin_role extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}', ['name', 'type', 'description', 'created_at', 'updated_at'], [
            ['admin', 1, 'Admin role', 1577973884, 1577973884],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200102_140149_add_admin_role cannot be reverted.\n";

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
