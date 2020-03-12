<?php

namespace common\helpers;

use Yii;

/**
 * Class RoleHelper
 * @package common\helpers
 */
final class RoleHelper
{
    const ROLE_ADMIN = 'admin';
    const ROLE_LIBRARIAN = 'librarian';

    /**
     * @return array
     */
    public static function getForSelector(): array
    {
        return [
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
            self::ROLE_LIBRARIAN => Yii::t('app', 'Librarian'),
        ];
    }

    /**
     * @param string $role
     * @return string
     */
    public static function getRoleName(string $role): string
    {
        return self::getForSelector()[$role];
    }
}