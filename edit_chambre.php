<?php
include './includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM chambres WHERE id_chambre = :id");
    $stmt->execute([':id' => $id]);
    $chambre = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$chambre) {
        echo "Chambre non trouvée.";
        exit;
    }
} else {
    echo "ID non fourni.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_hotel = $_POST["id_hotel"];
    $type_chambre = $_POST["type_chambre"];
    $prix = $_POST["prix"];
    $disponibilite = $_POST["disponibilite"];
    $nombre_lits = $_POST["nombre_lits"];
    $discription = $_POST["discription"];
    $floor = $_POST["floor"];


    $stmt = $pdo->prepare("UPDATE chambres SET id_hotel = :id_hotel, type_chambre = :type_chambre, prix = :prix, disponibilite = :disponibilite, discription = :discription,floor = :floor,
                nombre_lits = :nombre_lits WHERE id_chambre = :id");
    $stmt->execute([
        ':id_hotel' => $id_hotel,
        ':type_chambre' => $type_chambre,
        ':prix' => $prix,
        ':disponibilite' => $disponibilite,
        ':discription' => $discription,
        ':floor' => $floor,

        ':nombre_lits' => $nombre_lits,
        ':id' => $id
    ]);

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Chambre</title>
</head>
<body>
    <h1>Modifier Chambre #<?= htmlspecialchars($chambre['id_chambre']) ?></h1>
    <form method="POST">
        <label>ID Hôtel:</label><br>
        <input type="text" name="id_hotel" value="<?= htmlspecialchars($chambre['id_hotel']) ?>" required><br><br>

        <label>Type de Chambre:</label><br>
        <input type="text" name="type_chambre" value="<?= htmlspecialchars($chambre['type_chambre']) ?>" required><br><br>

        <label>Prix:</label><br>
        <input type="number" name="prix" value="<?= htmlspecialchars($chambre['prix']) ?>" required><br><br>

        <label>Discription:</label><br>
        <input type="text" name="discription" value="<?= htmlspecialchars($chambre['discription']) ?>" required><br><br>

        <label>Etage:</label><br>
        <input type="text" name="floor" value="<?= htmlspecialchars($chambre['floor']) ?>" required><br><br>


        <label>Disponibilité:</label><br>
        <select name="disponibilite" required>
            <option value="Disponible" <?= $chambre['disponibilite'] === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
            <option value="Occupée" <?= $chambre['disponibilite'] === 'Occupée' ? 'selected' : '' ?>>Occupée</option>
        </select><br><br>

        <label>Nombre de lits:</label><br>
        <input type="number" name="nombre_lits" value="<?= htmlspecialchars($chambre['nombre_lits']) ?>" required><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
