<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%category}}`.
 */
class m200104_055811_add_is_deleted_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'is_deleted', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'is_deleted');
    }
}
