<?php

use yii\db\Migration;

/**
 * Class m200102_140120_add_book_permission
 */
class m200102_140120_add_book_permission extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}', ['name', 'type', 'description', 'created_at', 'updated_at'], [
            ['viewBook', 2, 'View a book', 1577973884, 1577973884],
            ['createBook', 2, 'Create a book', 1577973884, 1577973884],
            ['updateBook', 2, 'Update a book', 1577973884, 1577973884],
            ['deleteBook', 2, 'Delete a book', 1577973884, 1577973884],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200102_140120_add_book_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200102_140120_add_book_permission cannot be reverted.\n";

        return false;
    }
    */
}
