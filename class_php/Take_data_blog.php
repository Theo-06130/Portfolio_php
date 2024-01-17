<?php
require_once 'Database.php';
class Take_data_blog extends Database
{
    public function getFormDataBlog(): array
    {
        // Récupérez les valeurs des champs du formulaire
        return array(
            'Titre' => htmlspecialchars($_POST['Titre'] ?? ''),
            'Contenu' => htmlspecialchars($_POST['Contenu'] ?? ''),
            'Id_Theme' => htmlspecialchars($_POST['Id_Theme'] ?? '')
        );
    }
}