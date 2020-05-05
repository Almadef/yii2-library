<?php

namespace backend\controllers\traits;

use Yii;
use yii\caching\TagDependency;

trait CacheManagementTraits
{
    public function clearCache()
    {
        if ($this->getCacheTags()) {
            TagDependency::invalidate(Yii::$app->cache, $this->getCacheTags());
        }
    }

    public function getCacheTags()
    {
        return [];
    }
}