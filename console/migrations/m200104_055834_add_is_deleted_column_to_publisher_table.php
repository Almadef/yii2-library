<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%publisher}}`.
 */
class m200104_055834_add_is_deleted_column_to_publisher_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%publisher}}', 'is_deleted', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%publisher}}', 'is_deleted');
    }
}
