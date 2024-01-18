<?php
session_start(); // Assurez-vous que la session est démarrée

require_once '../Config/config.php';
require_once '../class_php/Database.php';
require_once '../class_php/BlogProcess.php';

$database = new Database();

try {
    $database->connect();
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

$blogProcess = new BlogProcess($database);

// Afficher tous les blogs
$blogs = $blogProcess->getAllBlogs();

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
    foreach ($blogs as $blog) {
        echo "<div class='blog'>";
        echo "<p class='Titre'>";
        // Afficher les détails du blog (assurez-vous d'échapper les données pour éviter les failles XSS)
        echo htmlspecialchars($blog['Titre']) . "<br>";
        echo "</p>";
        echo "<p class='Contenu'>";
        echo htmlspecialchars($blog['Contenu']) . "<br>";
        echo "</p>";
        echo "<p class='Date'>";
        echo htmlspecialchars($blog['Date']) . "<br>";
        echo "</p>";
        echo "</div>";
        echo "<hr>";
    }
    ?>

</body>

</html>
