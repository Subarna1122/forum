<?php
namespace app\core;

use app\migrations\m0001_initial;
use app\migrations\m0002_initial;
use \PDO;

class Database
{   
    public \PDO $pdo;
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? "";
        $user = $config['user'] ?? "";
        $password = $config['password'] ?? "";
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);     
    }
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $newMigrations = [];
        $files = scandir(Application::$rootdir.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach($toApplyMigrations as $migrations) {
            if($migrations === "." || $migrations === "..") {
                continue;
            }
            require_once Application::$rootdir.'/migrations/$migrations';
            $className = pathinfo($migrations, PATHINFO_FILENAME);
            $instance = new $className();
            echo "Applying migrations $migrations".PHP_EOL;
            $instance->up();
            echo "Applied migrations $migrations".PHP_EOL;
            $newMigrations[] = $migrations;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($migrations);
        } else {
            echo "All migrations are applied";
        }
    }
    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migrations VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
            ) ENGINE =INNODB");
    }
    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migrations FROM migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
    public function saveMigrations(array $migrations) {
        $str = implode(",",array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migrations) VALUES 
        ('m0001_initial.php'),
        ('m0002_initial.php')
        ");
        $statement->execute();
    }
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}

