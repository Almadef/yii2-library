<?php

namespace common\models\publisher;

use common\helpers\LanguagesHelper;
use Exception;

/**
 * Trait Multilang
 *
 * @package common\models\publisher
 */
trait Multilang
{
    /**
     * @throws Exception
     *
     * @return string
     */
    public function getName(): string
    {
        $name = LanguagesHelper::getCurrentAttribute('name');

        return $this->$name;
    }
}
