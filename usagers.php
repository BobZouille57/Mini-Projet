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

$query = $pdo->query("SELECT * FROM usager");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Usagers</title>
    <link rel="stylesheet" href="css/usagers.css">
</head>
<body>
    <main>
        <h1>Gestion des Usagers</h1>

        <div class="add-user-link">
            <a href="ajouter_usager.php">Ajouter un Usager</a>
        </div>
        <h2>Liste des Usagers</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Caution</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $query->fetch()) : ?>
                <tr>
                    <td><?php echo $row['id_carte']; ?></td>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['id_categorie']; ?></td>
                    <td><?php echo $row['montant_caution']; ?> €</td>
                    <td>
                        <a href="modifier_usager.php?id=<?php echo $row['id_carte']; ?>">Modifier</a>
                        <a href="supprimer_usager.php?id=<?php echo $row['id_carte']; ?>">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
