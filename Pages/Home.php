<?php
require_once '../Config/config.php';
require_once '../class_php/Database.php';

$database = new Database();
try {
    $database->connect();

    // Reste du code
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="../style/Home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="name">
        <div class="icon_name">
            <p>T</p>
        </div>

        <h2>Portfolio Théo CERKOWNIK</h2>
    </div>
    <nav>
        <img src="../assets/add.svg" alt="add_button" onclick="location.href = 'Choice_Edit.php';">
        <a href="Home.php">Accueil</a>
        <a href="blog.php">Blog</a>
        <a href="Contact.php">Contact</a>
    </nav>
</header>
<main>
</main>
</body>
</html>
