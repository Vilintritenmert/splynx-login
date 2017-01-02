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
class SignupForm extends Model
{
    public $name;
    public $email;
    public $city;
    public $street_1;
    public $street_2;
    public $zip_code;
    public $password;
    public $confirm_password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'email','password','confirm_password','city','street_1','zip_code'], 'required'],

            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            // rememberMe must be a boolean value
            ['email', 'email'],
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function signup()
    {


        return false;
    }

}
