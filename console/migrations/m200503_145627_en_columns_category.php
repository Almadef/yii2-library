<?php

use yii\db\Migration;

/**
 * Class m200503_145627_en_columns_category
 */
class m200503_145627_en_columns_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%category}}', 'title', 'title_ru');
        $this->addColumn('{{%category}}', 'title_en', $this->string()->notNull()->unique()->after('title_ru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%category}}', 'title_ru', 'title');
        $this->dropColumn('{{%category}}', 'title_en');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_145627_en_columns_category cannot be reverted.\n";

        return false;
    }
    */
}
