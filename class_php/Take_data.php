<?php
require_once 'Database.php';
class Take_data extends Database
{
    public function getFormData(): array
    {
        // Récupérez les valeurs des champs du formulaire
        return array(
            'nom' => htmlspecialchars($_POST['nom'] ?? ''),
            'description' => htmlspecialchars($_POST['description'] ?? ''),
            'langage' => htmlspecialchars($_POST['langage'] ?? ''),
            'collaborateur' => htmlspecialchars($_POST['collaborateur'] ?? ''),
            'date_start' => htmlspecialchars($_POST['date_start'] ?? ''),
            'date_end' => htmlspecialchars($_POST['date_end'] ?? ''),
            'id_theme' => htmlspecialchars($_POST['id_theme'] ?? '')
        );
    }
}