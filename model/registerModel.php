<?php
namespace app\model;

use app\core\Model;

class RegisterModel extends Model
{
    public string $firstname = "";
    public string $lastname = "";
    public string $email = "";
    public string $password = "";
    public string $rpassword = "";

    public function register()
    {
        echo "Creating account";
    }
    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_Email, self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 25]],
            'rpassword' => [self::RULE_MATCH, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }




}