<?php

use yii\db\Migration;

/**
 * Class m200503_050211_add_clear_cache_permission
 */
class m200503_050211_add_clear_cache_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert('{{%auth_item}}',
            ['name', 'type', 'description', 'created_at', 'updated_at'], [
                ['clearCache', 2, 'Clear cache', 1577973889, 1577973889],
            ])->execute();

        Yii::$app->db->createCommand()->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['admin', 'clearCache'],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200503_050211_add_clear_cache_permission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_050211_add_clear_cache_permission cannot be reverted.\n";

        return false;
    }
    */
}
