<?php

class BlogProcess
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAllBlogs(): array
    {
        $query = $this->database->prepare("SELECT * FROM blog");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    // Vous pouvez ajouter d'autres méthodes pour ajouter, supprimer ou mettre à jour des blogs
}
