<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../Config/config.php';                    //récupération des fichiers pour la BDD et le fonctionnel
require_once '../class_php/Contact_traitement.php';
require_once '../class_php/Database.php';

$database = new Database();

try {
    $database->connect();       // Connexion BDD

    $contactFormHandler = new ContactFormHandler($database);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $confirmationMessage = $contactFormHandler->saveFormToDatabase();       //post du formulaire de contact
        echo $confirmationMessage;
    }

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();    // gestion des erreurs de connexion
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <script src="../script/switch_mode.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/login&Contact.css" rel="stylesheet" />
    <link rel="stylesheet" href="../style/body_mobile_Contact_login.css">

    <title>Contact</title>
</head>
<body>

<img class="return_Contact" src="../assets/return.svg" alt="Retour page précédente" onclick="location.href = 'Home.php';" >
<form action="Contact.php" method="post">
    <div class="container">
        <div class="card">
            <a class="login">Nous contacter</a>
            <div class="inputBox">
                <input type="text" id="subject" name="subject" maxlength="50" required>
                <span class="Subject">Subject*</span>
            </div>

            <div class="inputBox">
                <input type="text" id="first_name" name="first_name" maxlength="50" required>
                <span>First_name*</span>
            </div>

            <div class="inputBox">
                <input type="text" id="last_name" name="last_name" maxlength="50" required>
                <span>Last_name*</span>
            </div>

            <div class="inputBox">
                <input type="email" id="email" name="email" maxlength="50" required>
                <span>e-mail*</span>
            </div>

            <div class="inputBox">
                <input type="tel" id="phone" name="phone" maxlength="50">
                <span>Tel</span>
            </div>

            <div class="inputBox">
                <input id="message" name="message" maxlength="500">
                <span>Message</span>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="submit" value="Envoyer" class="enter">
        </div>

    </div>
</form>
</body>

</html>
