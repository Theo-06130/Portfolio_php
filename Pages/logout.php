<?php
// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_unset();            // destruction de toutes les variables dans la session
session_destroy();          // destruction de la session
header("Location: login.php"); // Redirigez vers la page de connexion après la déconnexion
exit();
