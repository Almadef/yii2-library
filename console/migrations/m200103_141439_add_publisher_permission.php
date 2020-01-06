<?php

use yii\db\Migration;

/**
 * Class m200103_141439_add_publisher_permission
 */
class m200103_141439_add_publisher_permission extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}',
            ['name', 'type', 'description', 'created_at', 'updated_at'], [
                ['viewPublisher', 2, 'View a publisher', 1577973884, 1577973884],
                ['createPublisher', 2, 'Create a publisher', 1577973884, 1577973884],
                ['updatePublisher', 2, 'Update a publisher', 1577973884, 1577973884],
                ['deletePublisher', 2, 'Delete a publisher', 1577973884, 1577973884],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['admin', 'viewPublisher'],
            ['admin', 'createPublisher'],
            ['admin', 'updatePublisher'],
            ['admin', 'deletePublisher'],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['librarian', 'viewPublisher'],
            ['librarian', 'createPublisher'],
            ['librarian', 'updatePublisher'],
            ['librarian', 'deletePublisher'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200103_141439_add_publisher_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200103_141439_add_publisher_permission cannot be reverted.\n";

        return false;
    }
    */
}
