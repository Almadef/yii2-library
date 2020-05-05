<?php

use yii\db\Migration;

/**
 * Class m200503_145640_en_columns_author
 */
class m200503_145640_en_columns_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%author}}', 'name', 'name_ru');
        $this->addColumn('{{%author}}', 'name_en', $this->string()->notNull()->unique()->after('name_ru'));

        $this->renameColumn('{{%author}}', 'surname', 'surname_ru');
        $this->addColumn('{{%author}}', 'surname_en', $this->string()->notNull()->unique()->after('surname_ru'));

        $this->renameColumn('{{%author}}', 'patronymic', 'patronymic_ru');
        $this->addColumn('{{%author}}', 'patronymic_en', $this->string()->notNull()->unique()->after('patronymic_ru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%author}}', 'name_ru', 'name');
        $this->dropColumn('{{%author}}', 'name_en');

        $this->renameColumn('{{%author}}', 'surname_ru', 'surname');
        $this->dropColumn('{{%author}}', 'surname_en');

        $this->renameColumn('{{%author}}', 'patronymic_ru', 'patronymic');
        $this->dropColumn('{{%author}}', 'patronymic_en');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_145640_en_columns_author cannot be reverted.\n";

        return false;
    }
    */
}
