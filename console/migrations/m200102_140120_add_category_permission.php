<?php

use yii\db\Migration;

/**
 * Class m200102_140120_add_category_permission
 */
class m200102_140120_add_category_permission extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\db\Exception
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}', ['name', 'type', 'description', 'created_at', 'updated_at'], [
            ['viewCategory', 2, 'View a category', 1577973884, 1577973884],
            ['createCategory', 2, 'Create a category', 1577973884, 1577973884],
            ['updateCategory', 2, 'Update a category', 1577973884, 1577973884],
            ['deleteCategory', 2, 'Delete a category', 1577973884, 1577973884],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200102_140120_add_Category_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200102_140120_add_Category_permission cannot be reverted.\n";

        return false;
    }
    */
}
