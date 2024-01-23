<?php
require_once 'Database.php'; // récupération info connexion bdd
class Take_data extends Database
{
    public function getFormData(): array
    {
        // Récupère les valeurs des champs du formulaire
        return array(
            'nom' => htmlspecialchars($_POST['nom'] ?? '', ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars($_POST['description'] ?? '', ENT_QUOTES, 'UTF-8'),
            'langage' => htmlspecialchars($_POST['langage'] ?? '', ENT_QUOTES, 'UTF-8'),
            'collaborateur' => htmlspecialchars($_POST['collaborateur'] ?? '', ENT_QUOTES, 'UTF-8'),
            'date_start' => htmlspecialchars($_POST['date_start'] ?? '', ENT_QUOTES, 'UTF-8'),
            'date_end' => htmlspecialchars($_POST['date_end'] ?? '', ENT_QUOTES, 'UTF-8'),
            'id_theme' => htmlspecialchars($_POST['id_theme'] ?? '', ENT_QUOTES, 'UTF-8'),

        );
    }
}