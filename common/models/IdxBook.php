<?php

namespace common\models;

use yii\sphinx\ActiveRecord;

/**
 * Class IdxBook
 * @package common\models
 *
 * @property int $id
 */
class IdxBook extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function indexName()
    {
        return 'idx_book';
    }

    /**
     * @param string $param
     * @return array
     */
    public static function search(string $param):array
    {
        \Yii::$app->cache->flush();
        $idxBooks = self::find()->match($param)->all();
        $ids = array();
        foreach ($idxBooks as $idxBook) {
            $ids[] = $idxBook->id;
        }
        return $ids;
    }
}