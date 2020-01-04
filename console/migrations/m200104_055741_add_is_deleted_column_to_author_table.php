<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%author}}`.
 */
class m200104_055741_add_is_deleted_column_to_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%author}}', 'is_deleted', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%author}}', 'is_deleted');
    }
}
