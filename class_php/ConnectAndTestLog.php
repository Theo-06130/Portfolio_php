<?php


    /**
     * @return void
     */
    function ConnectAndTestLog(): void
    {
        if (!isset($_SESSION['username']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {   // Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
            header("Location: login.php");
            exit();
        }

        $database = new Database();

        try {
            $database->connect();       // Connexion BDD
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();    // gestion des erreurs de connexion
            exit();
        }
    }
