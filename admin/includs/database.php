<?php


class Database {
    private $username = 'sammy';
    private $password = 'password';
    private $host = 'localhost';
    private $dbname = 'admin';
    private $charset = 'utf8';
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function testConnection() {
        try {
            $query = $this->pdo->query("SELECT 1");
            return $query ? true : false;
        } catch (PDOException $e) {
            return false;
        }
    }

   

      
}



