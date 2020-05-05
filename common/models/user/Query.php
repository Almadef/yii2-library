<?php

namespace common\models\user;

use common\models\interfaces\QuerySafeDeleteInterface;
use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\User]].
 *
 * @see \common\models\User
 */
final class Query extends \yii\db\ActiveQuery implements QuerySafeDeleteInterface
{
    /**
     * {@inheritdoc}
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['{{%user}}.is_deleted' => false]);
    }

    /**
     * @param $id
     * @return Query
     */
    public function byId($id)
    {
        return $this->andWhere(['{{%user}}.id' => $id]);
    }

    /**
     * @param $username
     * @return Query
     */
    public function byUsername($username)
    {
        return $this->andWhere(['{{%user}}.username' => $username]);
    }

    /**
     * @param $status
     * @return Query
     */
    public function byStatus($status)
    {
        return $this->andWhere(['{{%user}}.status' => $status]);
    }

    /**
     * @param $passwordResetToken
     * @return Query
     */
    public function byPasswordResetToken($passwordResetToken)
    {
        return $this->andWhere(['{{%user}}.password_reset_token' => $passwordResetToken]);
    }

    /**
     * @param $verificationToken
     * @return Query
     */
    public function byVerificationToken($verificationToken)
    {
        return $this->andWhere(['{{%user}}.verification_token' => $verificationToken]);
    }
}
