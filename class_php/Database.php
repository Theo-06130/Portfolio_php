<?php
class Database {
    protected $connection;
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $password = DB_PASSWORD;
    private string $dbname = DB_NAME;
//    protected $conn;

    public function __construct()
    {
        $this->connect();
    }

    /**
     * @throws Exception
     */
    public function connect(): void
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->connection = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    /**
     * @param string $query
     * @return PDOStatement
     */
    public function prepare(string $query): PDOStatement
    {
        return $this->connection->prepare($query);
    }
}
