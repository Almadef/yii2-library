<?php

namespace common\models;

use common\models\storage\ActiveRecord;

/**
 * Class Storage
 * @package common\models
 *
 * @property int $id
 * @property int $model_id
 * @property string $model_name
 * @property string $description
 * @property string $file_name
 * @property string $file_type
 * @property int $file_size
 * @property string $file_path
 * @property int $created_at
 * @property int $updated_at
 * @property int $is_deleted
 */
final class Storage extends ActiveRecord
{

}
