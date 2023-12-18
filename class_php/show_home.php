<?php
// Show_Home.php

class Show_Home
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function displayProjects()
    {
        // Récupérer les données des projets depuis la base de données
        $projectsData = $this->database->getAllProjects(); // Assurez-vous que vous avez une méthode dans votre classe Database pour récupérer les projets

        // Trier les projets par date de début (croissante)
        usort($projectsData, function ($a, $b) {
            return strtotime($a['Date_Start']) - strtotime($b['Date_Start']);
        });

        // Afficher les projets récursivement
        $this->displayRecursiveProjects($projectsData, null);
    }



    public function displayRecursiveProjects($projectsData, $parentDate = null)
    {
        foreach ($projectsData as $project) {
            echo "Projet actuel : " . $project['Nom'] . ' - Date de début : ' . $project['Date_Start'] . "<br>";

            if ($project['Date_Start'] == $parentDate) {
                echo "Affichage du projet : " . $project['Nom'] . ' - Date de début : ' . $project['Date_Start'] . "<br>";

                // Appel récursif pour traiter les sous-projets si nécessaire
                $this->displayRecursiveProjects($projectsData, $project['Date_Start']);
            }
        }
    }


}

