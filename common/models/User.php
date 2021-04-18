<?php

namespace common\models;

use common\helpers\UserHelper;
use common\models\auth\Assignment;
use common\models\user\ActiveRecord;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property bool $is_deleted
 * @property Assignment $role
 * @property Book[] $books
 */
final class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @return array
     */
    public static function getStatusForSelector(): array
    {
        return [
            self::STATUS_BANNED => Yii::t('app', 'Banned'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::find()
            ->byId($id)
            ->byStatus(self::STATUS_ACTIVE)
            ->isNoDeleted()
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->byUsername($username)
            ->byStatus(self::STATUS_ACTIVE)
            ->isNoDeleted()
            ->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::find()
            ->byPasswordResetToken($token)
            ->byStatus(self::STATUS_ACTIVE)
            ->isNoDeleted()
            ->one();
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     *
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     *
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::find()
            ->byVerificationToken($token)
            ->byStatus(self::STATUS_INACTIVE)
            ->isNoDeleted()
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     *
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = UserHelper::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     *
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = UserHelper::generateAuthKey();
    }

    /**
     * Generates new password reset token
     *
     * @throws Exception
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = UserHelper::generatePasswordResetToken();
    }

    /**
     * Generates new token for email verification
     *
     * @throws Exception
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = UserHelper::generateEmailVerificationToken();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
