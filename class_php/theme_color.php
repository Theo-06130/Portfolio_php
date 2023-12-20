<?php

class theme_color
{
    private $themeColors;

    public function __construct()
    {
        // Initialisez les couleurs de thème
        $this->themeColors = array(
            1 => '#00A7E1', // Couleur pour le thème avec l'ID 1
            2 => '#003459', // Couleur pour le thème avec l'ID 2
            3 => '#0F91D2', // Couleur pour le thème avec l'ID 3
            // Ajoutez autant d'entrées que nécessaire pour chaque thème
        );
    }

    public function getColorById($themeId): string
    {
        // Récupérez la couleur du thème par son ID
        return $this->themeColors[$themeId] ?? '#ffffff'; // Couleur par défaut (blanc) si l'ID du thème n'est pas trouvé
    }
}
