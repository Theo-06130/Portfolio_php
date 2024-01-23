<?php
require_once '../class_php/Database.php';               //récupération des fichiers pour la BDD et le fonctionnel
require_once '../class_php/InscriptionHandler.php';
require_once '../Config/config.php';
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
ConnectAndTestLog();

$inscriptionHandler = new InscriptionHandler($database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {            //post formulaire d'inscription
    $username = $_POST['username'];
    $userProvidedPassword = $_POST['password'];

                                                        //appel fonction inscription
    $inscriptionHandler->processInscription($username, $userProvidedPassword);

                                                        // Redirige vers page de connexion après inscription
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
