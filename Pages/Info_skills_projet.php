<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../Config/config.php';            //récupération des fichiers pour la BDD et le fonctionnel
require_once '../class_php/Database.php';
require_once '../class_php/info_skills_projet_Process.php';


$database = new Database();

try {
    $database->connect();           // Connexion BDD
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();    // gestion des erreurs de connexion
    exit();
}
$info_skills_projet = new info_skills_projet_Process($database);


$info_projet = $info_skills_projet->Show_project();

$info_skills = $info_skills_projet->Show_Skills();


?>


<html lang="fr">
<head>
    <script src="../script/switch_mode.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/info_skills_projet.css">
    <title>Informations compétences et projet</title>
</head>
<body>
<img class="return_info" src="../assets/return.svg" alt="Retour page précédente" onclick="location.href = 'Home.php';" >
<button class="switch_info" onclick="switchMode()">Projets/compétences</button>
    <div class="projet_div" id="projet">
        <div class="colonne_card">
            <h3>Tous mes projets</h3>
            <?php                               //boucle affichage info projet
            foreach ($info_projet as $info) {
                echo "<div class='card'>";
                echo "<p class='Nom'>";
                echo "Titre du projet: " . "<strong>" . $info['Nom'] . "</strong>" . "<br>";
                echo "</p>";
                echo "<p class='Description'>";
                echo "Description du projet: " . "<strong>" . $info['Description'] . "</strong>" . "<br>";
                echo "</p>";
                echo "<p class='Langage'>";
                echo "Langage utilisé: " . "<strong>" . $info['Langage'] . "</strong>" . "<br>";
                echo "</p>";
                echo "<p class='Date_End'>";
                echo "Date de fin: " . "<strong>" . $info['Date_End'] . "</strong>" . "<br>";
                echo "</p>";
                echo "</div>";
            }
            ?>

        </div>
        </div>
    <div class="skills_div hidden" id="skills">
        <div class="colonne_card">
            <h3>Toutes mes compétences</h3>
            <?php                               //boucle affichage info compétences
            foreach ($info_skills as $info) {
                echo "<div class='card'>";
                echo "<p class='Nom'>";
                echo "Nom de la compétence: " . "<strong>" . $info['Nom'] . "</strong>" . "<br>";
                echo "</p>";
                echo "<p class='Date_Learn'>";
                echo "Date d'apprentissage: " . "<strong>" . $info['Date_Learn'] . "</strong>" . "<br>";
                echo "</p>";
                echo "</div>";
            }
            ?>

        </div>



    </div>
</body>
<script>        // script switch entre projet et skills pour responsive
    const skills = document.getElementById("skills");
    const projet = document.getElementById("projet");
    let modeProjet = false;

    function switchMode() {
        if (modeProjet === false) {
            showProjet();
        } else {
            showSkills();
        }
    }

    function showProjet() {
        skills.classList.add("hidden");
        projet.classList.remove("hidden");
        modeProjet = true;
    }

    function showSkills() {
        projet.classList.add("hidden");
        skills.classList.remove("hidden");
        modeProjet = false;
    }
</script>
</html>

