<?php
namespace app\model;

use app\core\Model;
use Dbmodel;

class RegisterModel extends Dbmodel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETE = 2;
    public string $firstname = "";
    public string $lastname = "";
    public string $status = self::STATUS_INACTIVE;
    public string $email = "";
    public string $password = "";
    public string $rpassword = "";

    public function tableName(): string
    {
        return "users";
    }

    public function save()
    {
        $this->status
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }
    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' =>'RegisterModel'],
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 25]],
            'rpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ]];
    }
    public function attributes(): array
    {
        return['firstname', 'lastname', 'email', 'password', 'status'];
    }
    public function lables(): array
    {
        return[
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'rpassword' => 'Confirm Password',

        ];
    }



}