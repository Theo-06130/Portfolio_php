<?php


session_start();
session_unset();
session_destroy();
header("Location: login.php"); // Redirigez vers la page de connexion après la déconnexion
exit();
