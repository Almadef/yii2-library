<?php

namespace common\models\author;

use common\helpers\LanguagesHelper;
use Exception;

/**
 * Trait Multilang
 *
 * @package common\models\author
 */
trait Multilang
{
    /**
     * @throws Exception
     *
     * @return string
     */
    public function getSurname(): string
    {
        $surname = LanguagesHelper::getCurrentAttribute('surname');

        return $this->$surname;
    }

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

    /**
     * @throws Exception
     *
     * @return string|null
     */
    public function getPatronymic()
    {
        $patronymic = LanguagesHelper::getCurrentAttribute('patronymic');

        return $this->$patronymic;
    }
}
