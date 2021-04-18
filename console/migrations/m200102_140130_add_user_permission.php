<?php

use yii\db\Migration;

/**
 * Class m200102_140130_add_user_permission
 */
class m200102_140130_add_user_permission extends Migration
{
    /**
     * {@inheritdoc}
     *
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert(
            '{{%auth_item}}',
            ['name', 'type', 'description', 'created_at', 'updated_at'],
            [
                ['viewUser', 2, 'View an user', 1577973884, 1577973884],
                ['createUser', 2, 'Create a user', 1577973884, 1577973884],
                ['updateUser', 2, 'Update a user', 1577973884, 1577973884],
                ['deleteUser', 2, 'Delete a user', 1577973884, 1577973884],
            ]
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200102_140130_add_user_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200102_140130_add_author_permission cannot be reverted.\n";

        return false;
    }
    */
}
