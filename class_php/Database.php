<?php
class Database {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    protected $conn;


    public function connect() {

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}
