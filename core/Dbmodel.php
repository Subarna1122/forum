<?php

use app\core\Application;
use app\core\Model;

abstract class Dbmodel extends Model
{
    abstract public function tableName():string;
    abstract public function attributes():array;


    public function save()
    {
       $tableName = $this->tableName();
       $attributes = $this->attributes(); 
       $params = array_map(fn($attr) => ":attr", $attributes);
       $statement = self::prepare("INSERT INTO $tableName(".implode(",", $attributes).")
                VALUES(".implode(",", $params).")");
       $statement->execute();
       return true;         
    }
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
    
}