<?php
// Contact.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../Config/config.php';
require_once '../class_php/Contact_traitement.php';
require_once '../class_php/Database.php';

$database = new Database();

try {
    $database->connect();

    $contactFormHandler = new ContactFormHandler($database);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $confirmationMessage = $contactFormHandler->saveFormToDatabase();
        echo $confirmationMessage;
    }

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/login&Contact.css" rel="stylesheet" />
    <title>Contact</title>
</head>
<body>

<img class="return_Contact" src="../src/return.svg" alt="Retour page précédente" onclick="location.href = 'Home.php';" >
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
