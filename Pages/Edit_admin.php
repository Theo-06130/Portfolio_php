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
    $Data_Process->processFormData($formData);
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
        * {
            background-color: #0A0A0A;
            color: #F1F1F1;
        }
    </style>

    <form action="Edit_admin.php" method="post">
        <label for="operation">Opération :</label>
        <select id="operation" name="operation">
            <option value="Default">Choisir une option</option>
            <option value="Ajouter" id="add">Ajouter</option>
            <option value="Modifier" id="edit">Modifier</option>
            <option value="Supprimer" id="del">Supprimer</option>
            <option value="Afficher" id="show">Afficher</option>
        </select>
        <br>

        <label for="nom" id="nom-label">Nom :</label>
        <input type="text" id="nom" name="nom">
        <br>

        <label for="description" id="description-label">Description :</label>
        <input type="text" id="description" name="description">
        <br>

        <label for="langage" id="langage-label">Langage :</label>
        <input type="text" id="langage" name="langage">
        <br>

        <label for="collaborateur" id="collaborateur-label">Collaborateur :</label>
        <input type="text" id="collaborateur" name="collaborateur">
        <br>

        <label for="date_start" id="date_start-label">Date de début :</label>
        <input type="date" id="date_start" name="date_start" value="2023-12-11">
        <br>

        <label for="date_end" id="date_end-label">Date de fin :</label>
        <input type="date" id="date_end" name="date_end" value="2023-12-11">
        <br>

        <label for="id_theme" id="id_theme-label">ID du thème :</label>
        <input type="text" id="id_theme" name="id_theme">
        <br>

        <input type="submit" value="Envoyer">
    </form>


</body>

</html>