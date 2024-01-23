<?php
if (session_status() == PHP_SESSION_NONE) { // vérification si la session a démarré sinon démarrage
    session_start();
}
require_once '../Config/config.php';        //récupération des fichiers pour la BDD et le fonctionnel
require_once '../class_php/Database.php';
require_once '../class_php/BlogProcess.php';

$database = new Database(); // création nouvel instance de la class database

try {
    $database->connect();                   // Connexion BDD
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();            // gestion des erreurs de connexion
    exit();
}

$blogProcess = new BlogProcess($database);      //Création nouvel instance de la classe BlogProcess


$blogs = $blogProcess->getAllBlogs();           // appel fonction d'affichage de tous les blogs dans la variable $blogs

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../script/switch_mode.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/blog.css">
    <title>Blog</title>
</head>

<body>
<img class="return" src="../assets/return.svg" alt="Retour page précédente" onclick="location.href = 'Home.php';" >
<h1>Liste des blogs</h1>
<div class="blog_group">
    <?php
    foreach ($blogs as $blog) {         // boucle pour afficher tous les blogs
        echo "<div class='blog'>";
        echo "<p class='Titre'>";
        echo $blog['Titre'] . "<br>";     // affichage des titres
        echo "</p>";
        echo "<p class='Contenu'>";
        echo $blog['Contenu'] . "<br>"; // affichage Contenu
        echo "</p>";
        echo "<p class='Date'>";
        echo $blog['Date'] . "<br>";  //affichage Date
        echo "</p>";
        echo "</div>";
        echo "<hr>";
    }
    ?>



</body>

</html>
