<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../Config/config.php';                //récupération des fichiers pour la BDD et le fonctionnel
require_once '../class_php/Database.php';
require_once '../class_php/Take_data_blog.php';
require_once '../class_php/EditBlogProcess.php';
require_once '../class_php/ConnectAndTestLog.php';



// Vérifier si l'utilisateur est connecté, sinon le rediriger vers la page de connexion
ConnectAndTestLog();

$Take_Data_Blog = new Take_data_blog();
$EditBlogProcess = new EditBlogProcess();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $Take_Data_Blog->getFormDataBlog();
    try {
        $EditBlogProcess->processFormDataBlog($formData);       //lance la fonction qui choisi quelle partie du crud faire
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
    <img class="return_Edit_admin" src="../assets/return.svg" alt="Retour page précédente" onclick="location.href = 'Home.php';" >
    <form action="Edit_blog.php" method="post">
        <div class="container_Edit_admin">
            <div class="card">
                <label for="operation">Changement admin blog :</label>
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
                    <input type="text" id="Titre" name="Titre">
                    <span class="user">Titre</span>
                </div>

                <div class="inputBox">
                    <input type="text" id="Contenu" name="Contenu">
                    <span class="Contenu">Contenu</span>
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
