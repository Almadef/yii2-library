<?php

namespace common\models\book;

use common\models\Publisher;

/**
 * Trait Relations
 * @package common\models\book
 */
trait Relations
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }
}