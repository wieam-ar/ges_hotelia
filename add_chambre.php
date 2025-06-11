<?php
include './includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $type_chambre = $_POST['type_chambre'];
    $id_hotel = $_POST['id_hotel'];
    $prix = $_POST['prix'];
    $floor = $_POST['floor'];
    $disponibilite = $_POST['disponibilite'];
    $nombre_lits = $_POST['nombre_lits'];
    $discription= $_POST['discription'];

    $sql = "INSERT INTO chambres ( id_hotel, type_chambre, prix, disponibilite, nombre_lits, floor , discription)
            VALUES ( :id_hotel, :type_chambre, :prix, :disponibilite, :nombre_lits, :floor , :discription	)";

    $stmt = $pdo->prepare($sql);

    $success = $stmt->execute([
        ':id_hotel' => $id_hotel,
        ':type_chambre' => $type_chambre,
        ':prix' => $prix,
        ':disponibilite' => $disponibilite,
        ':nombre_lits' => $nombre_lits,
        ':discription' => $discription,
        ':floor' => $floor
    ]);

    if ($success) {
        echo "<script>alert('✅ Chambre ajoutée avec succès !');</script>";
        header("Location: admin.php");
        exit;
    } else {
        echo  "<script>alert('❌ Une erreur s'est produite.');</script>";
        header("Location: admin.php");
        exit;
    }
}

