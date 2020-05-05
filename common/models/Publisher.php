<?php

namespace common\models;

use common\models\publisher\ActiveRecord;
use common\models\publisher\Multilang;
use Exception;
use yii\helpers\ArrayHelper;

/**
 * Class Publisher
 * @package common\models
 *
 * @property int $id
 * @property string $name
 * @property string $name_ru
 * @property string $name_en
 * @property int $created_at
 * @property int $updated_at
 * @property bool $is_deleted
 *
 * @property Book[] $books
 */
final class Publisher extends ActiveRecord
{
    use Multilang;

    /**
     * @return array
     * @throws Exception
     */
    public static function getForSelector(): array
    {
        return ArrayHelper::map(
            self::find()->isNoDeleted()->all(),
            'id',
            'name'
        );
    }
}
