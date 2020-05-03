<?php

namespace backend\controllers;

use Yii;
use yii\caching\TagDependency;

trait CacheManagement
{
    public function getCacheTags()
    {
        return [];
    }

    public function clearCache()
    {
        if ($this->getCacheTags()) {
            TagDependency::invalidate(Yii::$app->cache, $this->getCacheTags());
        }
    }
}