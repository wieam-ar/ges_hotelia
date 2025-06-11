<?php
include './includes/db.php';

// Vérifie si l'ID est passé dans l'URL
if (isset($_GET['id_client']) && is_numeric($_GET['id'])) {
    $id_client = $_GET['id_client'];

    // Préparer et exécuter la requête pour récupérer les données utilisateur
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id_client = ?");
    $stmt->execute([$id_client]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($client) {
        // Affichage du profil utilisateur
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Profil Utilisateur</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body class="bg-light">
            <div class="container py-5">
                <div class="card mx-auto" style="max-width: 500px;">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Profil de <?= htmlspecialchars($client['nom']) ?></h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nom :</strong> <?= htmlspecialchars($client['nom']) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($client['email']) ?></p>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($client['telephone']) ?></p>
                        <p><strong>Date d'inscription :</strong> <?= htmlspecialchars($client['created_at']) ?></p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "<div class='container mt-5 alert alert-warning'>Utilisateur non trouvé.</div>";
    }
} else {
    echo "<div class='container mt-5 alert alert-danger'>ID utilisateur invalide ou manquant.</div>";
}
?>
