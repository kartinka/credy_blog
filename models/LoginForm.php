<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password. Additionally checking if the user is in the group of admins
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate() && $this->inGroup()) {
            return Yii::$app->user->login($this->getUser(), 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->username);
        }

        return $this->_user;
    }
    
    public function inGroup()
    {
        if ((boolean)$this->_user->in_group)
            return true;
            
        $this->addError('username', 'You have no access to the Group');            
        return false;            
    }
}