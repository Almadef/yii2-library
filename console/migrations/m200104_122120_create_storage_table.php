<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%storage}}`.
 */
class m200104_122120_create_storage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%storage}}',
            [
                'id' => $this->primaryKey(),
                'model_id' => $this->integer()->notNull(),
                'model_name' => $this->string()->notNull(),
                'description' => $this->string()->notNull(),
                'file_name' => $this->string()->notNull(),
                'file_type' => $this->string()->notNull(),
                'file_size' => $this->integer()->notNull(),
                'file_path' => $this->string()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'is_deleted' => $this->boolean()->notNull()->defaultValue(false),
            ]
        );

        $this->createIndex(
            'idx-storage-model_id',
            '{{%storage}}',
            'model_id'
        );

        $this->createIndex(
            'idx-storage-model_name',
            '{{%storage}}',
            'model_name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-storage-model_id',
            '{{%storage}}'
        );

        $this->dropIndex(
            'idx-storage-model_name',
            '{{%storage}}'
        );

        $this->dropTable('{{%storage}}');
    }
}
