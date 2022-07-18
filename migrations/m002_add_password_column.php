<?php

use app\core\Application;

class m002_add_password_column
{
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE USER ADD COLUMN password(521) NOT NULL");
    }
    public function down()
    {
        
        $db = Application::$app->db;
        $db->pdo->exec("ALTER TABLE USER DROP COLUMN password(521) NOT NULL");
    }
}


