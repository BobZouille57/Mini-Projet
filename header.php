<?php
session_start();
require_once 'bdd.php';

if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT nom, prenom, avatar, droits FROM users WHERE id_users = ?");
    $stmt->execute([$_SESSION['id_users']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $user_name = htmlspecialchars($user['prenom'] . ' ' . $user['nom']);
        $avatar = htmlspecialchars($user['avatar']);
        $droits = $user['droits'];  // On récupère les droits
    } else {
        session_destroy();
        header("Location: login.php");
        exit();
    }
} catch (PDOException $e) {
    error_log("Erreur BDD : " . $e->getMessage());
    die("❌ Une erreur est survenue. Veuillez réessayer plus tard.");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page avec header</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<header>
    <div class="header-container">
        <div class="avatar">
            <img src="upload/<?php echo !empty($avatar) ? $avatar : 'default-avatar.png'; ?>" alt="Avatar de <?php echo $user_name; ?>">
        </div>
        <div class="user-info">
            <p>Bienvenue, <?php echo $user_name; ?> !</p>
        </div>

        <nav class="menu">
            <button class="menu-btn">Menu ▼</button>
            <ul class="menu-list">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="tarifs.php">Tarifs</a></li>
                <?php if ($droits == 1): ?>
                    <li><a href="usagers.php">Administration</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <a href="logout.php" class="logout-btn">Se déconnecter</a>
    </div>
</header>
