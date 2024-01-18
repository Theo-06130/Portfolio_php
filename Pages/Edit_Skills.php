<?php


require_once '../Config/config.php';
require_once '../class_php/Database.php';
require_once '../class_php/Take_data_skills.php';
require_once '../class_php/EditSkillsProcess.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
if (!isset($_SESSION['username']) || !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$database = new Database();

try {
    $database->connect();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

$Take_Data_skills = new Take_data_skills();
$EditSkillsProcess = new EditSkillsProcess();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $Take_Data_skills->getFormDataSkills();
    try {
        $EditSkillsProcess->processFormDataSkills($formData);
    } catch (Exception $e) {
        // Gérer l'exception, par exemple, afficher un message d'erreur
        echo "Erreur : " . $e->getMessage();
        // Vous pouvez prendre d'autres mesures en cas d'erreur de traitement des données
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../script/switch_mode.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/Edit_admin.css">
    <link rel="stylesheet" href="../style/login&Contact.css">
    <title>Edit_Blog</title>
</head>

<body>


<div class="input_div">
    <img class="return_Edit_admin" src="../assets/return.svg" alt="Retour page précédente"
         onclick="location.href = 'Home.php';">
    <form action="Edit_Skills.php" method="post">
        <div class="container_Edit_admin">
            <div class="card">
                <label for="operation">Changement admin skills :</label>
                <select id="operation" name="operation" onchange="handleOperationChange()">
                    <option value="Default">Choisir une option</option>
                    <option value="Ajouter" id="add">Ajouter</option>
                    <option value="Modifier" id="edit">Modifier</option>
                    <option value="Supprimer" id="del">Supprimer</option>
                    <option value="Afficher" id="show">Afficher</option>
                </select>
                <div class="inputBox" id="Choix_id">
                    <input type="number" min="0" name="Choix_id">
                    <span class="user">Choix ID</span>
                </div>
                <div class="inputBox">
                    <input type="text" id="Nom" name="Nom">
                    <span class="user">Nom</span>
                </div>

                <div class="inputBox">
                    <input type="Date" id="Date_Learn" name="Date_Learn">
                    <span class="Contenu">Date appris</span>
                </div>

                <div class="inputBox">
                    <input type="text" id="Id_Theme" name="Id_Theme">
                    <span class="user">Id theme</span>
                </div>
                <input type="submit" name="envoyer" class="enter">
    </form>
    <a href="logout.php">Se déconnecter</a>
</div>


</body>
<script src="../script/input_edit.js"></script>
</html>
