<?php

class theme_color                   // class inutilisé pour l'instant dans le but de filtré en fonction du theme
{
    private $themeColors;

    public function __construct()
    {
        // Initialisation des couleurs de thème
        $this->themeColors = array(
            1 => '#00A7E1', // Couleur pour le thème avec l'ID 1
            2 => '#003459', // Couleur pour le thème avec l'ID 2
            3 => '#0F91D2', // Couleur pour le thème avec l'ID 3

        );
    }

    public function getColorById($themeId): string
    {
        // Récupérez la couleur du thème par son ID
        return $this->themeColors[$themeId] ?? '#ffffff';
    }
}
