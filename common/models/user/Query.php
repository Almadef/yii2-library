<?php

namespace common\models\user;

use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\User]].
 *
 * @see \common\models\User
 */
class Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

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
     * @return Query
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['is_deleted' => false]);
    }

    /**
     * @param $id
     * @return Query
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $username
     * @return Query
     */
    public function byUsername($username)
    {
        return $this->andWhere(['username' => $username]);
    }

    /**
     * @param $status
     * @return Query
     */
    public function byStatus($status)
    {
        return $this->andWhere(['status' => $status]);
    }

    /**
     * @param $passwordResetToken
     * @return Query
     */
    public function byPasswordResetToken($passwordResetToken)
    {
        return $this->andWhere(['password_reset_token' => $passwordResetToken]);
    }

    /**
     * @param $verificationToken
     * @return Query
     */
    public function byVerificationToken($verificationToken)
    {
        return $this->andWhere(['verification_token' => $verificationToken]);
    }
}
