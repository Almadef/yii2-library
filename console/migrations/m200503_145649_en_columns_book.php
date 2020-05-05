<?php

use yii\db\Migration;

/**
 * Class m200503_145649_en_columns_book
 */
class m200503_145649_en_columns_book extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%book}}', 'title', 'title_ru');
        $this->addColumn('{{%book}}', 'title_en', $this->string()->notNull()->unique()->after('title_ru'));

        $this->renameColumn('{{%book}}', 'description', 'description_ru');
        $this->addColumn('{{%book}}', 'description_en', $this->string()->notNull()->unique()->after('description_ru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%book}}', 'title_ru', 'title');
        $this->dropColumn('{{%book}}', 'title_en');

        $this->renameColumn('{{%book}}', 'description_ru', 'description');
        $this->dropColumn('{{%book}}', 'description_en');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_145649_en_columns_book cannot be reverted.\n";

        return false;
    }
    */
}
