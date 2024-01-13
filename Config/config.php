<?php
const DB_HOST = '127.0.0.2';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'bdd_portfolio_php';


// Dans votre fichier d'initialisation, par exemple, config.php

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Générer un jeton CSRF et le stocker dans la session
if (!isset($_SESSION['csrf_token'])) {
    try {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } catch (\Random\RandomException $e) {
    }
}
