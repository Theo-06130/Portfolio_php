<?php
require_once 'Database.php'; // récupération info connexion bdd
class Take_data_skills
{
    public function getFormDataSkills(): array
    {
        // Récupère les valeurs des champs du formulaire
        return array(
            'Nom' => htmlspecialchars($_POST['Nom'] ?? '', ENT_QUOTES, 'UTF-8'),
            'Date_Learn' => htmlspecialchars($_POST['Date_Learn'] ?? '', ENT_QUOTES, 'UTF-8'),
            'Id_Theme' => htmlspecialchars($_POST['Id_Theme'] ?? '', ENT_QUOTES, 'UTF-8'),

        );
    }
}