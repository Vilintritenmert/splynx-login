<?php

namespace app\models;

use Yii;
use yii\base\Model;
use splynx\base\BaseApiModel;
use splynx\helpers\ApiHelper;
use splynx\models\Customer;
use dosamigos\transliterator\TransliteratorHelper;

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
    public $user_login;

    public static $apiUrl = 'admin/customers/customer';

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
        $this->user_login = str_replace(' ','_',TransliteratorHelper::process($this->name, '', 'en'));

        $request = [
            'login' => $this->user_login,
            'status' => 'new',
            'partner_id' => 1,
            'location_id' => 1,
            'category' => 'person'
        ];

        $request = array_merge($request, array_only($this->attributes, ['name', 'email', 'city', 'street_1', 'street_2', 'zip_code','password']));

        $result = ApiHelper::getInstance()->post(self::$apiUrl, $request);

        return array_key_exists('id',$result) ? $result['id'] : 0;
    }

}
