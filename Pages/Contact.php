<?php
// Contact.php

require_once '../Config/config.php';
require_once '../class_php/Contact_traitement.php'; // Assurez-vous que le fichier est correctement inclus
require_once '../class_php/Database.php';

$database = new Database(); // Initialisez votre instance de Database

try {
    $database->connect(); // Établissez la connexion à la base de données

    $contactFormHandler = new ContactFormHandler($database);
    $confirmationMessage = $contactFormHandler->saveFormToDatabase();



    // Reste du code pour le formulaire de contact
} catch (Exception $e) {
    // Gérer l'exception, par exemple, afficher un message d'erreur
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
<h1>Contactez-nous</h1>
    <form action="Contact.php" method="post">
        <label for="subject">Sujet* :</label>
        <input type="text" id="subject" name="subject" required>

        <label for="first_name">Prénom* :</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Nom* :</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">E-mail* :</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Téléphone :</label>
        <input type="tel" id="phone" name="phone">

        <label for="message">Message* :</label>
        <textarea id="message" name="message" required></textarea>
        <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
