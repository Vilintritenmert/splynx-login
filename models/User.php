<?php

namespace app\models;

class User extends \yii\base\Model
{
    public $id;
    public $name;
    public $email;
    public $address;
    public $password;

    const SCENARIO_REGISTER = 'register';

    public function rules()
    {
        return [
            // username, email and password are all required in "register" scenario
            [['name', 'email', 'password','confirm_password','address'], 'required', 'on' => 'register'],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_REGISTER => ['name', 'email', 'password', 'confirm_password', 'address'],
        ];
    }


}
