<?php

namespace common\helpers;

use Yii;

/**
 * Class RoleHelper
 *
 * @package common\helpers
 */
final class RoleHelper
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_LIBRARIAN = 'librarian';
    public const ROLE_USER = 'user';

    /**
     * @param string $role
     *
     * @return string
     */
    public static function getRoleName(string $role): string
    {
        return self::getForSelector()[$role];
    }

    /**
     * @return array
     */
    public static function getForSelector(): array
    {
        return [
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
            self::ROLE_LIBRARIAN => Yii::t('app', 'Librarian'),
            self::ROLE_USER => Yii::t('app', 'User'),
        ];
    }
}
