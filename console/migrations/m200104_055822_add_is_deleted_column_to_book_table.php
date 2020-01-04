<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%book}}`.
 */
class m200104_055822_add_is_deleted_column_to_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%book}}', 'is_deleted', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%book}}', 'is_deleted');
    }
}
