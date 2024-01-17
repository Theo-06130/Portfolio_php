<?php
require_once 'Database.php';
class Take_data_skills
{
    public function getFormDataSkills(): array
    {
        // Récupérez les valeurs des champs du formulaire
        return array(
            'Nom' => htmlspecialchars($_POST['Nom'] ?? ''),
            'Date_Learn' => htmlspecialchars($_POST['Date_Learn'] ?? ''),
            'Id_Theme' => htmlspecialchars($_POST['Id_Theme'] ?? '')
        );
    }
}