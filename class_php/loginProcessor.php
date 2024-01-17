<?php

class LoginProcessor
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function processLogin($username, $password, $csrfToken): void
    {
        // Vérifier le jeton CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
            die("Erreur CSRF. Veuillez réessayer.");
        }

        // Valider l'authentification avec le mot de passe haché
        if ($this->authenticate($username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;

            // Authentification réussie, rediriger vers Edit_admin.php
            header("Location: ../Pages/Choice_Edit.php");
            exit();
        } else {
            // Authentification échouée, afficher un message d'erreur
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }

    private function authenticate($username, $password): bool
    {
        $query = $this->db->prepare("SELECT * FROM admin WHERE Name = ?");
        $query->execute([$username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Pswd'])) {
            return true;
        }

        return false;
    }

}