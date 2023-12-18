<?php
require_once '../Config/config.php';

class Database {

    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    protected $conn;

    /**
     * @throws Exception
     */
    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Laissez le code appelant gérer l'erreur en lançant une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getAllProjects()
    {
        try {
            $query = "SELECT * FROM projet";
            $result = $this->conn->query($query);

            if ($result) {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return array(); // Retourne un tableau vide en cas d'erreur ou de résultat vide
            }
        } catch (PDOException $e) {
            // Laissez le code appelant gérer l'erreur en lançant une exception
            throw new Exception("Erreur de requête SQL : " . $e->getMessage());
        }
    }
}
