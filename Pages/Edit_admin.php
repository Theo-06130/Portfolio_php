<?php
require_once '../Config/config.php';
require_once '../class_php/Database.php';
require_once '../class_php/Take_data.php';
require_once '../class_php/Data_Process.php';

$database = new Database();
$Take_Data = new Take_data();
$Data_Process = new Data_Process();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $Take_Data->getFormData();

    if (isset($_POST['operation'])) {
        switch ($_POST['operation']) {
            case "Ajouter":
                echo "Ajouter";
                $Data_Process->processFormData($formData);
                break;
            case "Supprimer":
                echo "Supprimer";
                // Ajoutez ici le code pour supprimer un projet
                break;
            case "Modifier":
                echo "Modifier";
                // Ajoutez ici le code pour modifier un projet
                break;
            case "Afficher":
                echo "Afficher";
                // Ajoutez ici le code pour afficher un projet
                break;
            default:
                echo "";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
<style>
    *{
        background-color: #0A0A0A;
        color: #F1F1F1;
    }
</style>

<form action="Edit_admin.php" method="post">
    <label for="operation">Opération :</label>
    <select id="operation" name="operation">
        <option value="Default">Choisir une option</option>
        <option value="Ajouter">Ajouter</option>
        <option value="Modifier">Modifier</option>
        <option value="Supprimer">Supprimer</option>
        <option value="Afficher">Afficher</option>
    </select>
    <br>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" >
    <br>

    <label for="description">Description :</label>
    <input type="text" id="description" name="description" >
    <br>

    <label for="langage">Langage :</label>
    <input type="text" id="langage" name="langage" >
    <br>

    <label for="collaborateur">Collaborateur :</label>
    <input type="text" id="collaborateur" name="collaborateur" >
    <br>

    <label for="date_start">Date de début :</label>
    <input type="date" id="date_start" name="date_start" value="2023-12-11" >
    <br>

    <label for="date_end">Date de fin :</label>
    <input type="date" id="date_end" name="date_end" value="2023-12-11" >
    <br>

    <label for="id_theme">ID du thème :</label>
    <input type="text" id="id_theme" name="id_theme" >
    <br>

    <input type="submit" value="Envoyer">
</form>

</body>
</html>
