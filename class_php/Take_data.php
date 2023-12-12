<?php
require_once 'Database.php';
class Take_data extends Database
{
    public function getFormData(): array
    {
        // Récupérez les valeurs des champs du formulaire
        return array(
            'nom' => $_POST['nom'] ?? '',
            'description' => $_POST['description'] ?? '',
            'langage' => $_POST['langage'] ?? '',
            'collaborateur' => $_POST['collaborateur'] ?? '',
            'date_start' => $_POST['date_start'] ?? '',
            'date_end' => $_POST['date_end'] ?? '',
            'id_theme' => $_POST['id_theme'] ?? ''
        );
    }
}