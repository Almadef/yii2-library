<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fk_user_id_for_auth_assignment}}`.
 */
class m200227_123330_create_fk_user_id_for_auth_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%auth_assignment}}', 'user_id', $this->integer());

        $this->addForeignKey(
            '{{%fk-user_id-auth_assignment}}',
            '{{%auth_assignment}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-user_id-auth_assignment}}',
            '{{%auth_assignment}}',
        );

        $this->alterColumn('{{%auth_assignment}}', 'user_id', $this->string());
    }
}
