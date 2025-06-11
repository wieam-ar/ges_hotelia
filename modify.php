<?php
include './includes/db.php';

// Récupérer les données de l'hôtel
$id = $_GET['id'] ?? null;

if (!$id) {
    die("⛔ ID d'hôtel non fourni.");
}

$stmt = $pdo->prepare("SELECT * FROM hotels WHERE id_hotel = ?");
$stmt->execute([$id]);
$hotel = $stmt->fetch();

if (!$hotel) {
    die("⛔ Hôtel non trouvé.");
}

// Si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $filename = $hotel['image']; // valeur par défaut

    // S'il y a une nouvelle image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = $_FILES['image']['name'];
        $temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($temp, "uploads/" . $filename);
        
    }

    // Mettre à jour
    $stmt = $pdo->prepare("UPDATE hotels SET nom_hotel=?, adresse=?, image=? WHERE id_hotel=?");
    $stmt->execute([$nom, $adresse, $filename, $id]);

    echo "<div class='alert alert-success'>✅ Hôtel mis à jour avec succès.</div>";
    // Optionnel: redirection
    // header("Location: gestion_hotels.php"); exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier Hôtel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
  <div class="container">
    <h2 class="mb-4">✏️ Modifier Hôtel</h2>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Nom de l'hôtel</label>
        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($hotel['nom_hotel']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Adresse</label>
        <textarea name="adresse" class="form-control" required><?= htmlspecialchars($hotel['adresse']) ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Image actuelle</label><br>
        <img src="uploads/<?= htmlspecialchars($hotel['image']) ?>" width="150">
      </div>

      <div class="mb-3">
        <label class="form-label">Changer l'image (optionnel)</label>
        <input type="file" name="image" class="form-control">
      </div>

      <button class="btn btn-primary">Enregistrer</button>
      <a href="settings.php" class="btn btn-secondary">⬅ Retour</a>
    </form>
  </div>
</body>
</html>
