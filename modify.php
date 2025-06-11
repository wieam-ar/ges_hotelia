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
    $nom_hotel = $_POST['nom_hotel'] ?? '';
    $image = $_POST['image'] ?? '';
    $description = $_POST['description'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $email = $_POST['email'] ?? '';
    $site_web = $_POST['site_web'] ?? '';
    $ville = $_POST['ville'] ?? '';

    
    $filename = $hotel['image']; // valeur par défaut


    // S'il y a une nouvelle image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = $_FILES['image']['name'];
        $temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($temp, "uploads/" . $filename);
        
    }

    // Mettre à jour
    $stmt = $pdo->prepare("UPDATE hotels SET nom_hotel=?, ville=?, image=? , description=?, telephone=?, email=?, site_web=?  WHERE id_hotel=?");
    $stmt->execute([$nom_hotel, $ville, $filename, $description, $telephone, $email, $site_web, $id]);

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
      <div class=" mb-2"> <input type="text" name="nom_hotel" class="form-control" placeholder="Nom de l'hôtel" value="<?= $hotel['nom_hotel'] ?>" required> </div>
      <div class=" mb-2"> <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $hotel['email'] ?>" required> </div>
      <div class=" mb-2"> <input type="url" name="site_web" class="form-control" placeholder="Site Web " value="<?= $hotel['site_web'] ?>" required> </div>
      <div class=" mb-2"> <input type="text" name="ville" class="form-control" placeholder="Ville / Région" value="<?= $hotel['ville'] ?>" required> </div>
      <div class=" mb-2"> <input type="text" name="telephone" class="form-control" placeholder="Téléphone" value="<?= $hotel['telephone'] ?>" required> </div>
      <div class=" mb-2"> <input type="file" name="image" class="form-control" value="<?= $hotel['image'] ?>" required> </div>
      <div class="mb-2"> <textarea name="description" class="form-control" placeholder="Description" rows="4" value="<?= $hotel['description'] ?>"></textarea>
      <button class="btn btn-primary">Enregistrer</button>
      <a href="settings.php" class="btn btn-secondary">⬅ Retour</a>
    </form>
    
  </div>
</body>
</html>
