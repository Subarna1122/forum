<?php
namespace app\core;
abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'Match';
    public const RULE_UNIQUE = 'Unique';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
    }
}   
    abstract public function rules() :array;
    public function lables():array
    {
        return [];
    }
    public function getLable($attributes)
    {
        return $this->lables()[$attributes];
    }
    public array $errors = [];
    public function validation()
    {
        foreach ($this->rules() as $attributes => $rules) {
            // echo "<pre>";
            // var_dump($rules);
        
            $value = $this->{$attributes};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attributes, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attributes, self::RULE_EMAIL);  
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attributes, self::RULE_MIN, $rule);  
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                     $this->addError($attributes, self::RULE_MAX, $rule);  
                }
                if ($ruleName === self::RULE_MATCH && $value != $this->{$rule['match']}) {
                     $this->addError($attributes, self::RULE_MATCH, $rule);  
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['atribute'] ?? $attributes;
                    $tableName = $className::tableName();
                    $statement =  Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :attr");
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if($record) {
                        $this->addError($attributes, self::RULE_MATCH, ['field'=>$this->getLable([$attributes])]);
                    }
                }
            }
            
        }
        return empty($this->errors); 
        
    }
    public function addError(string $attributes, string $rules, $params = []) 
        {
            $message = $this->errorMessages()[$rules] ?? "";
            foreach ($params as $key => $value) {
                $message = str_replace("{{$key}}", $value, $message);
            }
            $this->errors[$attributes][] = $message;
        }
       
    public function errorMessages()
    {
        return [
         self::RULE_REQUIRED => 'This field is required',
         self::RULE_EMAIL => 'Email must be valid',
         self::RULE_MIN => 'Minimum length is {min}',
         self::RULE_MAX => 'Maximum length is {max}',
         self::RULE_MATCH => 'Passswords do not match with {match}',
         self::RULE_UNIQUE => 'Email with {field} already exists'

    ];
    }
    public function hasError($attributes) 
    {
        return $this->errors[$attributes] ?? false;   
    }
    public function getFirstError($attributes) 
    {
        return $this->errors[$attributes][0] ?? false; 
    }
}


