<?php
require_once 'header.php';
require_once 'bdd.php';

if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_users'];
$droits = $_SESSION['droits'];

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
        <h2>Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name']); ?> !</h2>
        <p><?php echo ($droits == 1) ? "Administrateur authentifié" : "Utilisateur authentifié"; ?></p>

        <?php if ($droits == 1): ?>
            <p><a href="usagers.php">🔧 Accéder à l'administration</a></p>
        <?php endif; ?>
    </main>
</body>
</html>
