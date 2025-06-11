<?php
include './includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: edit_client.php");
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    $stmt = $pdo->prepare("UPDATE clients SET nom = ?, email = ?, telephone = ?, adresse = ? WHERE id_client = ?");
    $stmt->execute([$nom, $email, $telephone, $adresse, $id_client]);

    header("Location: edit_client.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM clients WHERE id_client = ?");
$stmt->execute([$id]);
$client = $stmt->fetch();

if (!$client) {
    echo "Client non trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container">
    <h2>✏️ Modifier Client</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nom:</label>
            <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($client['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($client['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Téléphone:</label>
            <input type="text" name="telephone" class="form-control" value="<?= htmlspecialchars($client['telephone']) ?>">
        </div>
        <div class="mb-3">
            <label>Adresse:</label>
            <textarea name="adresse" class="form-control"><?= htmlspecialchars($client['adresse']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="custumers.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

</body>
</html>
