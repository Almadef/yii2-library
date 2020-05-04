<?php

namespace common\helpers;

use Yii;

/**
 * Class LanguagesHelper
 * @package common\helpers
 */
final class LanguagesHelper
{
    const RU = 'ru';
    const EN = 'en';

    /**
     * @return string
     * @throws \Exception
     */
    public static function getCurrentLanguage(): string
    {
        switch(Yii::$app->language) {
            case 'ru': case 'ru-ru': return self::RU;
            case 'en': case 'en-en': return self::EN;
            default: throw new \Exception('Languages no find');
        }
    }

    /**
     * @param string $attributeName
     * @return string
     */
    public static function getCurrentAttribute(string $attributeName): string
    {
        try {
            return $attributeName . '_' . self::getCurrentLanguage();
        } catch (\Exception $e) {
            return $attributeName;
        }
    }
}