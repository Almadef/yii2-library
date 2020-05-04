<?php

use yii\db\Migration;

/**
 * Class m200503_141333_en_columns_publisher
 */
class m200503_141333_en_columns_publisher extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%publisher}}', 'name', 'name_ru');
        $this->addColumn('{{%publisher}}', 'name_en', $this->string()->notNull()->unique()->after('name_ru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%publisher}}', 'name_ru', 'name');
        $this->dropColumn('{{%publisher}}', 'name_en');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_141333_en_columns_publisher cannot be reverted.\n";

        return false;
    }
    */
}
