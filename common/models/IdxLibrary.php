<?php

namespace common\models;

use yii\sphinx\ActiveRecord;
use yii\sphinx\MatchExpression;

/**
 * Class IdxLibrary
 * @package common\models
 *
 * @property int $id
 */
class IdxLibrary extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function indexName()
    {
        return 'idx_library';
    }

    /**
     * @param string $param
     * @return array
     */
    public static function search(string $param):array
    {
        $idxBooks = self::find()
            ->match(
                (new MatchExpression())
                    ->match(['b_title' => $param])
                    ->orMatch(['c_title' => $param])
                    ->orMatch(['p_name' => $param])
                    ->orMatch(['a_name' => $param])
                    ->orMatch(['a_surname' => $param])
                    ->orMatch(['a_patronymic' => $param])
            )
            ->all();
        $ids = array();
        foreach ($idxBooks as $idxBook) {
            $ids[] = $idxBook->id;
        }
        return $ids;
    }
}