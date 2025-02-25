<?php
require_once 'header.php';
require_once 'bdd.php'; 

if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['droits'] != 1) {
    echo "Accès interdit. Vous n'avez pas les droits nécessaires.";
    exit();
}

$id = $_GET['id'] ?? null;
if ($id === null) {
    echo "ID invalide.";
    exit();
}

$query = $pdo->prepare("DELETE FROM usager WHERE id_carte = ?");
$query->execute([$id]);

echo "Usager supprimé avec succès!";
header("Location: usagers.php");
exit();
