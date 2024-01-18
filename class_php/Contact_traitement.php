<?php

use Random\RandomException;

require_once 'Database.php';
#[AllowDynamicProperties]
class ContactFormHandler extends Database
{

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveFormToDatabase(): string
    {
        // Vérifier si la session est déjà active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $confirmationMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier le jeton CSRF
            if (!$this->isValidCsrfToken()) {
                // Jeton CSRF invalide, lancer une exception
                throw new RuntimeException("Erreur de sécurité. Veuillez réessayer.");
            }

            // Récupérer les données du formulaire
            $subject = htmlspecialchars($_POST["subject"]);
            $firstName = htmlspecialchars($_POST["first_name"]);
            $lastName = htmlspecialchars($_POST["last_name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $message = htmlspecialchars($_POST["message"]);

            // Validation des données (ajoutez votre propre logique de validation)

            try {
                // Enregistrement dans la base de données
                $this->saveToDatabase($subject, $firstName, $lastName, $email, $phone, $message);

                // Message de confirmation
                $confirmationMessage = "Votre message a été envoyé avec succès !";

                // Renouveler le jeton CSRF après chaque soumission réussie
                $this->generateCsrfToken();

                // Redirection après l'ajout
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();

            } catch (Exception $e) {
                // En cas d'erreur, afficher un message d'erreur
                $confirmationMessage = "Erreur lors de l'enregistrement du message : " . $e->getMessage();
            }
        }

        return $confirmationMessage;
    }




    private function saveToDatabase($subject, $firstName, $lastName, $email, $phone, $message): void
    {
        $this->database->connect();

        // Utilisez des requêtes préparées pour éviter les injections SQL
        $stmt = $this->database->connection->prepare("INSERT INTO contact (Nom, Prenom, Mail, Tel, Sujet, Message, Date) VALUES (?, ?, ?, ?, ?, ?, NOW())");

        $stmt->execute([$subject, $firstName, $lastName, $email, $phone, $message]);
    }


    // Fonction pour générer un jeton CSRF

    /**
     * @throws RandomException
     */
    function generateCsrfToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    private function isValidCsrfToken(): bool
    {
        return isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }

}


