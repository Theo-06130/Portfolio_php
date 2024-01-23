<?php

class BlogProcess
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAllBlogs(): array        //récupération des blogs et affichage de récent vers anciens
    {
        $query = $this->database->prepare("SELECT * FROM blog ORDER BY DATE DESC");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }
}
