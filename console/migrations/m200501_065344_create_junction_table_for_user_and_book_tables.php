<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_book}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%book}}`
 */
class m200501_065344_create_junction_table_for_user_and_book_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_book}}', [
            'user_id' => $this->integer(),
            'book_id' => $this->integer(),
            'PRIMARY KEY(user_id, book_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_book-user_id}}',
            '{{%user_book}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_book-user_id}}',
            '{{%user_book}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `book_id`
        $this->createIndex(
            '{{%idx-user_book-book_id}}',
            '{{%user_book}}',
            'book_id'
        );

        // add foreign key for table `{{%book}}`
        $this->addForeignKey(
            '{{%fk-user_book-book_id}}',
            '{{%user_book}}',
            'book_id',
            '{{%book}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-user_book-user_id}}',
            '{{%user_book}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_book-user_id}}',
            '{{%user_book}}'
        );

        // drops foreign key for table `{{%book}}`
        $this->dropForeignKey(
            '{{%fk-user_book-book_id}}',
            '{{%user_book}}'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            '{{%idx-user_book-book_id}}',
            '{{%user_book}}'
        );

        $this->dropTable('{{%user_book}}');
    }
}
