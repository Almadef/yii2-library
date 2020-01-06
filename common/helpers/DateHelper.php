<?php

namespace common\helpers;

use Yii;

/**
 * Class DateHelper
 * @package common\helpers
 */
final class DateHelper
{
    /**
     * @param int $unixDate
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function convertUnixToDatetime(int $unixDate): string
    {
        return Yii::$app->formatter->asDate($unixDate, 'php:Y-m-d H:i:s');
    }
}