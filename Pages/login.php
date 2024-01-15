<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../class_php/loginProcessor.php';
require_once '../Config/config.php';
require_once '../class_php/Database.php';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/login.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>
<img class="return" src="../src/return.svg" alt="Retour page précédente" onclick="location.href = 'Home.php';" >
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="container">
        <div class="card">
            <a class="login">Log in</a>
            <div class="inputBox">
                <input type="text" id="username" name="username" required>
                <span class="user">Username</span>
            </div>

            <div class="inputBox">
                <input type="password" id="password" name="password" required>
                <span>Password</span>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"

        </div>
        <input type="submit" value="Connexion" class="enter">
    </div>
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
