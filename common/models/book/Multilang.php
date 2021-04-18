<?php

namespace common\models\book;

use common\helpers\LanguagesHelper;
use Exception;

trait Multilang
{
    /**
     * @throws Exception
     *
     * @return string
     */
    public function getTitle(): string
    {
        $title = LanguagesHelper::getCurrentAttribute('title');

        return $this->$title;
    }

    /**
     * @throws Exception
     *
     * @return string
     */
    public function getDescription(): string
    {
        $description = LanguagesHelper::getCurrentAttribute('description');

        return $this->$description;
    }
}
