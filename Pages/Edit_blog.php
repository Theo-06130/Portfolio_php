<?php
session_start();

require_once '../Config/config.php';
require_once '../class_php/Database.php';
require_once '../class_php/EditBlogProcess.php';

$database = new Database();

try {
    $database->connect();
    $editBlogProcess = new EditBlogProcess($database);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

// Traiter les actions CRUD ici (Ajouter, Mettre à jour, Supprimer)
// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($editBlogProcess) && $_POST['action'] === 'add') {
        // Ajouter un blog
        $editBlogProcess->createBlog($_POST['Titre'], $_POST['Contenu'], $_POST['Date'], $_POST['Id_Theme']);

        // Redirection après l'ajout pour éviter le retrait du formulaire lors du rafraîchissement
        header("Location: Edit_blog.php");
        exit();
    } elseif (isset($editBlogProcess) && $_POST['action'] === 'update' && isset($_GET['Id_Blog'])) {
        // Mettre à jour un blog
        $blogId = $_GET['Id_Blog'];
        $editBlogProcess->updateBlog($blogId, $_POST['Titre'], $_POST['Contenu'], $_POST['Date'], $_POST['Id_Theme']);

        // Redirection après la mise à jour pour éviter le retrait du formulaire lors du rafraîchissement
        header("Location: Edit_blog.php");
        exit();
    } elseif (isset($editBlogProcess) && $_POST['action'] === 'delete' && isset($_GET['Id_Blog'])) {
        // Supprimer un blog
        $blogId = $_GET['Id_Blog'];

        // Ajout de messages de débogage
        echo "Avant la suppression - Blog ID: $blogId <br>";

        $editBlogProcess->deleteBlog($blogId);

        // Ajout de messages de débogage après la suppression
        echo "Après la suppression - Blog ID: $blogId <br>";

        // Redirection après la suppression pour éviter le retrait du formulaire lors du rafraîchissement
        header("Location: Edit_blog.php");
        exit();
    }
}

// ...

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les blogs</title>
</head>

<body>
<style>
    * {
        background-color: #0A0A0A;
        color: #F1F1F1;
    }

</style>

<h1>Modifier les blogs</h1>

<!-- Afficher la liste des blogs existants -->
<?php
if (isset($editBlogProcess)) {
    $blogs = $editBlogProcess->getAllBlogs();
    foreach ($blogs as $blog) {
        echo "<p>";
        echo "ID: " . $blog['Id_Blog'] . "<br>";
        echo "Titre: " . ($blog['Titre'] ? htmlspecialchars($blog['Titre']) : 'N/A') . "<br>";
        echo "Contenu: " . ($blog['Contenu'] ? htmlspecialchars($blog['Contenu']) : 'N/A') . "<br>";
        echo "Date: " . ($blog['Date'] ? htmlspecialchars($blog['Date']) : 'N/A') . "<br>";
        echo "Id_Theme: " . ($blog['Id_Theme'] ? htmlspecialchars($blog['Id_Theme']) : 'N/A') . "<br>";
        echo "<a href='Edit_blog.php?action=edit&Id_Blog=" . $blog['Id_Blog'] . "'>Éditer</a> | ";
        echo "<a href='Edit_blog.php?action=delete&Id_Blog=" . $blog['Id_Blog'] . "'>Supprimer</a>";
        echo "</p>";
    }
}
?>

<!-- Formulaire pour ajouter ou éditer un blog -->
<form action="Edit_blog.php" method="post">
    <label for="Titre">Titre:</label>
    <input type="text" name="Titre" required>
    <br>
    <label for="Contenu">Contenu:</label>
    <textarea name="Contenu" required></textarea>
    <br>
    <label for="Date">Date:</label>
    <input type="date" name="Date" required>
    <br>
    <label for="Id_Theme">ID du thème:</label>
    <input type="text" name="Id_Theme" required>
    <br>
    <input type="hidden" name="action" value="add"> <!-- Ajout par défaut -->
    <button type="submit">Ajouter</button>
</form>

<?php
// Gérer les actions du formulaire ici (Ajouter, Mettre à jour, Supprimer)
if (isset($editBlogProcess) && $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'edit' && isset($_GET['Id_Blog'])) {
    // Éditer un blog
    $blogId = $_GET['Id_Blog'];
    $blog = $editBlogProcess->getBlogById($blogId);
    if ($blog) {
        // Afficher le formulaire pré-rempli pour l'édition
        echo "<h2>Éditer le blog</h2>";
        echo "<form action='Edit_blog.php?action=update&Id_Blog=" . $blog['Id_Blog'] . "' method='post'>";
        echo "<label for='Titre'>Titre:</label>";
        echo "<input type='text' name='Titre' value='" . htmlspecialchars($blog['Titre']) . "' required>";
        echo "<br>";
        echo "<label for='Contenu'>Contenu:</label>";
        echo "<textarea name='Contenu' required>" . htmlspecialchars($blog['Contenu']) . "</textarea>";
        echo "<br>";
        echo "<label for='Date'>Date:</label>";
        echo "<input type='date' name='Date' value='" . htmlspecialchars($blog['Date']) . "' required>";
        echo "<br>";
        echo "<label for='Id_Theme'>ID du thème:</label>";
        echo "<input type='text' name='Id_Theme' value='" . htmlspecialchars($blog['Id_Theme']) . "' required>";
        echo "<br>";
        echo "<input type='hidden' name='action' value='update'>";
        echo "<button type='submit'>Mettre à jour</button>";
        echo "</form>";
    }
}
?>

</body>

</html>
