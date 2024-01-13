<?php
session_start();
require_once '../class_php/loginProcessor.php';
require_once '../Config/config.php';
require_once '../class_php/Database.php';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <!-- Ajoutez ici vos champs de formulaire pour le nom d'utilisateur et le mot de passe -->
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <!-- Ajoutez un champ pour le jeton CSRF -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <input type="submit" value="Connexion">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database(); // Instanciez votre classe Database ici
    $loginProcessor = new LoginProcessor($database);
    $loginProcessor->processLogin($_POST['username'], $_POST['password'], $_POST['csrf_token']);
}
?>
</body>
</html>
