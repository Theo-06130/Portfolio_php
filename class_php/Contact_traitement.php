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

    /**
     * @throws RandomException
     */
    public function saveFormToDatabase(): string
    {
        $confirmationMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier le jeton CSRF
            if (!$this->isValidCsrfToken()) {
                // Jeton CSRF invalide, lancer une exception
                throw new RuntimeException("Erreur de sécurité. Veuillez réessayer.");
            }

            // Récupérer les données du formulaire
            $subject = $_POST["subject"];
            $firstName = $_POST["first_name"];
            $lastName = $_POST["last_name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $message = $_POST["message"];

            // Validation des données (ajoutez votre propre logique de validation)

            // Enregistrement dans la base de données
            $this->saveToDatabase($subject, $firstName, $lastName, $email, $phone, $message);

            // Message de confirmation
            $confirmationMessage = "Votre message a été envoyé avec succès !";

            // Renouveler le jeton CSRF après chaque soumission réussie
            $this->generateCsrfToken();
        }

        return $confirmationMessage;
    }

    private function saveToDatabase($subject, $firstName, $lastName, $email, $phone, $message): void
    {
        $this->database->connect();

        // Utilisez des requêtes préparées pour éviter les injections SQL
        $stmt = $this->database->conn->prepare("INSERT INTO contact (Nom, Prenom, Mail, Tel, Sujet, Message, Date) VALUES (?, ?, ?, ?, ?, ?, NOW())");

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
        return isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'];
    }

}


