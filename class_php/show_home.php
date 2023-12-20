<?php
// Show_Home.php

class Show_Home
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function displayProjects(theme_color $themeColors)
    {
        // Récupérer les données des projets depuis la base de données
        $projectsData = $this->database->getAllProjects(); // Assurez-vous que vous avez une méthode dans votre classe Database pour récupérer les projets

        // Trier les projets par date de début (croissante)
        usort($projectsData, function ($a, $b) {
            return strtotime($a['Date_Start']) - strtotime($b['Date_Start']);
        });

        // Afficher les projets récursivement
        $this->displayRecursiveProjects($projectsData, null, $themeColors);
    }

    public function displayRecursiveProjects($projects, $parentDate, theme_color $themeColors)
    {
        echo "<div class='home-container'>";

        foreach ($projects as $project) {
            $projectDate = $project['Date_Start'];

            if ($projectDate !== $parentDate) {
                // Fermer la div précédente s'il y en a une
                if ($parentDate !== null) {
                    echo "</div>"; // Fermer la div pour les projets de la date précédente
                }

                echo "<div class='date'>$projectDate</div>";
                // Ouvrir une nouvelle div pour les projets de cette date
                echo "<div class='projects-container'>";
                $parentDate = $projectDate;
            }

            // Utilisez $themeColors pour obtenir la couleur du thème
            $color = $themeColors->getColorById($project['Id_theme']);

            echo "<div class='project' style='background-color: $color;'>";
            echo "<p>{$project['Nom']}</p>";

            // Appel récursif pour les éventuels sous-projets
            if (isset($project['sous_projets']) && is_array($project['sous_projets'])) {
                $this->displayRecursiveProjects($project['sous_projets'], $projectDate, $themeColors);
            }

            echo "</div>"; // Fermer le bloc de projet
        }

        echo "</div>"; // Fermer la div pour les projets de la dernière date
        echo "</div>"; // Fermer le conteneur de dates
    }
}
