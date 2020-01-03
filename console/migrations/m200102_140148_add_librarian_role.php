<?php

use yii\db\Migration;

/**
 * Class m200102_140148_add_librarian_role
 */
class m200102_140148_add_librarian_role extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}', ['name', 'type', 'description', 'created_at', 'updated_at'], [
            ['librarian', 1, 'Librarian role', 1577973884, 1577973884],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['librarian', 'viewBook'],
            ['librarian', 'createBook'],
            ['librarian', 'updateBook'],
            ['librarian', 'deleteBook'],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['librarian', 'viewAuthor'],
            ['librarian', 'createAuthor'],
            ['librarian', 'updateAuthor'],
            ['librarian', 'deleteAuthor'],
        ])->execute();

        Yii::$app->db->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['librarian', 'viewCategory'],
            ['librarian', 'createCategory'],
            ['librarian', 'updateCategory'],
            ['librarian', 'deleteCategory'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200102_140212_add_librarian_role cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200102_140212_add_librarian_role cannot be reverted.\n";

        return false;
    }
    */
}
