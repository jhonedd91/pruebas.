<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "prueba123";
    private $dbname = "pruebas";
    private $pdo;

    public function __construct() {
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
