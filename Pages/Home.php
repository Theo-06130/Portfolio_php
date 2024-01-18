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
    <script src="../script/switch_mode.js"></script>
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
        <div class="icon_name" onclick="location.href = 'Info_skills_projet.php';">
            <img src="../assets/info.svg" class="logo_info" alt="Informations">
            <p class="info">Info projet et compétences</p>
        </div>

        <h2>Portfolio Théo CERKOWNIK</h2>
    </div>
    <nav>
        <img src="../assets/add.svg" alt="add_button" onclick="location.href = 'Choice_Edit.php';">
        <a href="Home.php">Accueil</a>
        <a href="blog.php">Blog</a>
        <a href="Contact.php">Contact</a>
        <div class="toggle-switch" >
            <label class="switch-label" >
                <input type="checkbox" class="checkbox" id="toggle-theme-button">
                <span class="slider"></span>
            </label>
        </div>
    </nav>
</header>
<main>
    <article>
        <div class="info_perso">
            <h2>Théo Cerkownik</h2>
            <h4>Étudiant informatique</h4>
            <p>Née en février 2004, je suis actuellement en<strong> 2ᵉ années d'informatique</strong>, passionné de divers type de création, je suis <strong>développeur front-end</strong> dans la plupart des projets scolaire et extrascolaire. Bien que la création web m'intéresse énormément je suis <strong>curieux de découvrir</strong> d'autre domaine comme le <strong>réseau ou la cybersécurité</strong>, car ce sont des domaines qui sont à la fois remplis et complexes. </p>
        </div>
    </article>
    <aside>
        <div class="info_pro">
            <h2>Informations professionnel : </h2>
            <h4>En recherche de stage</h4>
            <p>En cours d'apprentissage de langage front-end tel que <strong>React.js, SCSS</strong> et préparation d'une <strong>spécialisation en réseau/cybersécurité</strong> </p>
        </div>
        <div class="passion">
            <h2>Mes passions :</h2>
            <h4>Créateur et voyageur</h4>
            J'ai de multiples passions en dehors de la création web comme la <strong>photographie, la vidéo, le sport et les jeux vidéo</strong>s. En plus de cela, <strong>j'aime voyager, créer des projets et la conduite en voiture /moto</strong>.
        </div>
    </aside>
</main>
</body>
</html>

