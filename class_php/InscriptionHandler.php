<?php

class InscriptionHandler
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function processInscription($username, $password): void
    {
        // Hacher le mot de passe avant l'enregistrement dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Enregistrement dans la base de données
        $query = $this->database->prepare("INSERT INTO admin (Name, Pswd) VALUES (?, ?)");
        $query->execute([$username, $hashedPassword]);
    }
}
