<?php

use Random\RandomException;

require_once 'Database.php'; // récupération info connexion bdd
#[AllowDynamicProperties]
class ContactFormHandler extends Database
{

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveFormToDatabase(): string
    {
                                                        // Vérifie si la session est déjà active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $confirmationMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                            // Vérifie le jeton CSRF
            if (!$this->isValidCsrfToken()) {
                // Jeton CSRF invalide, lancer une exception
                throw new RuntimeException("Erreur de sécurité. Veuillez réessayer.");
            }

                                                                // Récupérer les données du formulaire
            $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES, 'UTF-8');
            $firstName = htmlspecialchars($_POST["first_name"], ENT_QUOTES, 'UTF-8');
            $lastName = htmlspecialchars($_POST["last_name"], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
            $phone = htmlspecialchars($_POST["phone"], ENT_QUOTES, 'UTF-8');
            $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');




            try {
                                            // Enregistrement dans la base de données
                $this->saveToDatabase($subject, $firstName, $lastName, $email, $phone, $message);

                                            // Message de confirmation
                $confirmationMessage = "Votre message a été envoyé avec succès !";

                                            // Renouveler le jeton CSRF après chaque soumission réussie
                $this->generateCsrfToken();

                                            // Redirection après l'ajout pour éviter bug ajout apres refresh
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();

            } catch (Exception $e) {
                                        // si erreur affichage message
                $confirmationMessage = "Erreur lors de l'enregistrement du message : " . $e->getMessage();
            }
        }

        return $confirmationMessage;
    }



                                    // sauvegarde dans la bdd
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


