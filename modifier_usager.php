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

$query = $pdo->prepare("SELECT * FROM usager WHERE id_carte = ?");
$query->execute([$id]);
$user = $query->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $id_categorie = $_POST['id_categorie'];
    $montant_caution = $_POST['montant_caution'];
    $date_carte = $_POST['date_carte'];

    $updateQuery = $pdo->prepare("UPDATE usager SET nom = ?, id_categorie = ?, montant_caution = ?, date_carte = ? WHERE id_carte = ?");
    $updateQuery->execute([$nom, $id_categorie, $montant_caution, $date_carte, $id]);

    header("Location: usagers.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Usager</title>
    <link rel="stylesheet" href="css/modifier_usager.css">
</head>
<body>
    <main>
        <h1>Modifier l'Usager <?php echo $user['nom']; ?></h1>

        <form method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?php echo $user['nom']; ?>" required>

            <label for="id_categorie">Catégorie :</label>
            <select name="id_categorie" id="id_categorie" required>
                <option value="1" <?php if ($user['id_categorie'] == 1) echo 'selected'; ?>>Petits revenus</option>
                <option value="2" <?php if ($user['id_categorie'] == 2) echo 'selected'; ?>>Revenus moyens</option>
                <option value="3" <?php if ($user['id_categorie'] == 3) echo 'selected'; ?>>Gros revenus</option>
                <option value="4" <?php if ($user['id_categorie'] == 4) echo 'selected'; ?>>Visiteurs</option>
            </select>

            <label for="montant_caution">Montant Caution :</label>
            <input type="number" name="montant_caution" id="montant_caution" value="<?php echo $user['montant_caution']; ?>" required>

            <label for="date_carte">Date de carte :</label>
            <input type="date" name="date_carte" id="date_carte" value="<?php echo $user['date_carte']; ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>
    </main>
</body>
</html>
