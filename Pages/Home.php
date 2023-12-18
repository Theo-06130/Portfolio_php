<?php
// home.php
require_once '../Config/config.php';
require_once '../class_php/show_home.php';
require_once '../class_php/Database.php';

$database = new Database(); // Initialisez votre instance de Database
$showHome = new Show_Home($database);

try {
$database = new Database(); // Initialisez votre instance de Database
$database->connect(); // Établissez la connexion à la base de données

$showHome = new Show_Home($database);

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
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
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
        <img src="../assets/add.svg" alt="add_button">
        <h3>Accueil</h3>
        <h3>Blog</h3>
        <h3>Contact</h3>
    </nav>
</header>
<main>
    <?php
    // Afficher les projets récursivement
    $showHome->displayProjects();
    ?>
</main>
</body>
</html>
    <?php
} catch (Exception $e) {
    // Gérer l'exception, par exemple, afficher un message d'erreur
    echo "Erreur : " . $e->getMessage();
}
?>