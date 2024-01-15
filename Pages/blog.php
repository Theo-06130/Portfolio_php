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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>

<body>
<h1>Liste des blogs</h1>

<?php
foreach ($blogs as $blog) {
    // Afficher les détails du blog (assurez-vous d'échapper les données pour éviter les failles XSS)
    echo "Titre: " . htmlspecialchars($blog['Titre']) . "<br>";
    echo "Contenu: " . htmlspecialchars($blog['Contenu']) . "<br>";
    echo "Date: " . htmlspecialchars($blog['Date']) . "<br>";
    echo "<hr>";
}
?>

</body>

</html>
