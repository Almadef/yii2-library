<?php

namespace backend\modules\user\models;

use common\models\User;
use Yii;

/**
 * Class SaveUserForm
 * @package backend\modules\user\models
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $role_name
 * @property bool $is_deleted
 */
class SaveUserForm extends User
{
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $role_name;

    /**
     *
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'saveParams']);
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'saveRole']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'saveParams']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'saveRole']);
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['username', 'trim'];
        $rules[] = ['username', 'required'];
        $rules[] = [
            'username',
            'unique',
            'targetClass' => '\common\models\User',
            'message' => 'This username has already been taken.'
        ];
        $rules[] = ['username', 'string', 'min' => 2, 'max' => 255];

        $rules[] = ['email', 'trim'];
        $rules[] = ['email', 'required'];
        $rules[] = ['email', 'email'];
        $rules[] = ['email', 'string', 'max' => 255];
        $rules[] = [
            'email',
            'unique',
            'targetClass' => '\common\models\User',
            'message' => 'This email address has already been taken.'
        ];

        $rules[] = ['password', 'required'];
        $rules[] = ['password', 'string', 'min' => 6];

        $rules[] = ['role_name', 'required'];
        $rules[] = ['role_name', 'string'];

        return $rules;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'password' => Yii::t('app', 'Password'),
            'role_name' => Yii::t('app', 'Role Name'),
        ]);
    }

    /**
     * @throws \yii\base\Exception
     */
    protected function saveParams()
    {
        $this->generateAuthKey();
        $this->generateEmailVerificationToken();
        $this->setPassword($this->password);
    }

    /**
     *
     */
    protected function saveRole()
    {
        $auth = Yii::$app->authManager;
//        $user = User::find()->byUsername($this->username)->one();
        $auth->assign($auth->getRole($this->role_name), $this->id);
    }
}