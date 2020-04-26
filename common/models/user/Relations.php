<?php

namespace common\models\user;

use common\models\auth\Assignment;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\user
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Assignment::class, ['user_id' => 'id']);
    }
}