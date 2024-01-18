<?php
require_once '../class_php/Database.php'; // Assurez-vous d'inclure la classe Database
require_once '../class_php/InscriptionHandler.php'; // Assurez-vous d'inclure la classe InscriptionHandler
require_once '../Config/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
if (!isset($_SESSION['username']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$database = new Database(); // Initialisez votre instance de Database

try {
    $database->connect(); // Établissez la connexion à la base de données
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

$inscriptionHandler = new InscriptionHandler($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire d'inscription
    $username = $_POST['username'];
    $userProvidedPassword = $_POST['password'];

    // Processus d'inscription
    $inscriptionHandler->processInscription($username, $userProvidedPassword);

    // Rediriger vers la page de connexion après l'inscription
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<h1>Inscription</h1>
<form action="inscription.php" method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="S'inscrire">
</form>
</body>
</html>
