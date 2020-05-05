<?php

namespace common\models\book;

use common\helpers\LanguagesHelper;
use Exception;

trait Multilang
{
    /**
     * @return string
     * @throws Exception
     */
    public function getTitle(): string
    {
        $title = LanguagesHelper::getCurrentAttribute('title');
        return $this->$title;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDescription(): string
    {
        $description = LanguagesHelper::getCurrentAttribute('description');
        return $this->$description;
    }
}
