<?php
require_once 'header.php';
require_once 'bdd.php'; 

if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <main>
        <h2>Bienvenue sur la page d'accueil</h2>
        <p>Cette page est privée et réservée aux utilisateurs authentifiés.</p>
    </main>
</body>
</html>
