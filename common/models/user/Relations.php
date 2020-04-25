<?php

namespace common\models\user;

use common\models\auth\Assignment;

/**
 * Trait Relations
 * @package common\models\user
 */
trait Relations
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Assignment::class, ['user_id' => 'id']);
    }
}