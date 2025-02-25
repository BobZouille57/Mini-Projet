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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $id_categorie = $_POST['id_categorie'];
    $montant_caution = $_POST['montant_caution'];
    $date_carte = $_POST['date_carte'];

    $query = $pdo->prepare("INSERT INTO usager (nom, id_categorie, montant_caution, date_carte) VALUES (?, ?, ?, ?)");
    $query->execute([$nom, $id_categorie, $montant_caution, $date_carte]);

    header("Location: usagers.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Usager</title>
    <link rel="stylesheet" href="css/ajouter_usager.css">
</head>
<body>
    <main>
        <h1>Ajouter un Usager</h1>

        <form method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>

            <label for="id_categorie">Catégorie :</label>
            <select name="id_categorie" id="id_categorie" required>
                <option value="1">Petits revenus</option>
                <option value="2">Revenus moyens</option>
                <option value="3">Gros revenus</option>
                <option value="4">Visiteurs</option>
            </select>

            <label for="montant_caution">Montant Caution :</label>
            <input type="number" name="montant_caution" id="montant_caution" required>

            <label for="date_carte">Date de carte :</label>
            <input type="date" name="date_carte" id="date_carte" required>

            <button type="submit">Ajouter</button>
        </form>
    </main>
</body>
</html>
