<?php
require_once 'Database.php'; // récupération info connexion bdd
class Take_data_blog extends Database
{
    public function getFormDataBlog(): array
    {
        // Récupère les valeurs des champs du formulaire
        return array(
            'Titre' => htmlspecialchars($_POST['Titre'] ?? '', ENT_QUOTES, 'UTF-8'),
            'Contenu' => htmlspecialchars($_POST['Contenu'] ?? '', ENT_QUOTES, 'UTF-8'),
            'Id_Theme' => htmlspecialchars($_POST['Id_Theme'] ?? '', ENT_QUOTES, 'UTF-8')
        );
    }
}