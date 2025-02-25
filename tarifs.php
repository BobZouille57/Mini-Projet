<?php
require_once 'header.php';
require_once 'bdd.php';

if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_users'];

$query = $pdo->prepare("SELECT id_categorie FROM usager WHERE id_carte = ?");
$query->execute([$id_user]);
$id_categorie = $query->fetchColumn();

if (!$id_categorie) {
    echo "Catégorie non trouvée pour cet utilisateur.";
    exit();
}

$query = $pdo->prepare("
    SELECT p.nom AS prestation, t.prix 
    FROM tarif t
    JOIN prestation p ON t.id_prestation = p.id_prestation
    WHERE t.id_categorie = ?
");
$query->execute([$id_categorie]);
$prestations = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifs des Prestations</title>
    <link rel="stylesheet" href="css/tarifs.css">
</head>
<body>
    <main>
        <h1>Les Tarifs des Prestations</h1>
        <p>Voici les tarifs des prestations pour votre catégorie.</p>

        <ul class="tarif-list">
            <?php if ($prestations): ?>
                <?php foreach ($prestations as $prestation): ?>
                    <li class="tarif-item">
                        <span class="prestation-name"><?php echo htmlspecialchars($prestation['prestation']); ?></span>
                        <span class="prestation-tarif"><?php echo htmlspecialchars($prestation['prix']); ?>€</span>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucune prestation disponible pour votre catégorie.</li>
            <?php endif; ?>
        </ul>
    </main>
</body>
</html>
