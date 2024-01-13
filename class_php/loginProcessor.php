<?php

class LoginProcessor
{
    private Database $db; // Déclarez la propriété si nécessaire

    public function __construct(Database $db) // Assurez-vous d'ajouter le type d'objet approprié
    {
        $this->db = $db;
    }


    public function processLogin($username, $password, $csrfToken): void
    {
        // Vérifier le jeton CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
            die("Erreur CSRF. Veuillez réessayer.");
        }

        // Valider l'authentification
        if ($this->authenticate($username, $password)) {
            // Authentification réussie, rediriger vers Edit_admin.php
            header("Location: Edit_admin.php");
            exit();
        } else {
            // Authentification échouée, afficher un message d'erreur
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }

    private function authenticate($username, $password): bool
    {
        // Vous devez mettre en œuvre votre propre logique d'authentification ici
        // Assurez-vous d'utiliser des méthodes de hachage appropriées pour stocker et comparer les mots de passe.

        // Exemple basique sans hachage (ne pas utiliser en production)
        $query = $this->db->prepare("SELECT * FROM admin WHERE Name = ?");
        $query->execute([$username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['Pswd'] === $password) {
            return true;
        }

        return false;
    }
}
?>
