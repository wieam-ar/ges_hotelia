<?php
include './includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $method = $_POST['paymentMethod'] ?? '';
    $cardNumber = trim($_POST['cardNumber'] ?? '');
    $cardHolder = strtoupper(trim($_POST['cardHolder'] ?? ''));
    $expiryDate = trim($_POST['expiryDate'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $amounts = trim($_POST['amounts'] ?? '');

    $id_hotel = $_POST['id_hotel'];
    $id_chambre = $_POST['id_chambre'];
    $date_arrivee = $_POST['date_arrivee'];
    $date_depart = $_POST['date_depart'];
    $personnes = $_POST['personnes'];
    // Insertion dans la table reservations
    $sql2 = "INSERT INTO reservations (hotel_id, chambre_id, date_arrivee, date_depart, personnes, prix_total, status, client_id)
         VALUES (:hotel_id, :chambre_id, :date_arrivee, :date_depart, :personnes, :prix_total, :status, :client_id)";

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([
        ':hotel_id' => $id_hotel,
        ':chambre_id' => $id_chambre,
        ':date_arrivee' => $date_arrivee,
        ':date_depart' => $date_depart,
        ':personnes' => $personnes,
        ':prix_total' => $amounts,
        ':status' => 'confirmée', // ou "en attente" selon ta logique
        ':client_id' => $client_id // => récupéré depuis la session ou un input caché
    ]);

    // Préparer et exécuter l'insertion
    $sql = "INSERT INTO payments (method, card_number, card_holder, expiry_date, cvv ,amounts) 
            VALUES (:method, :card_number, :card_holder, :expiry_date, :cvv ,:amounts)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':method' => $method,
        ':card_number' => $cardNumber,
        ':card_holder' => $cardHolder,
        ':expiry_date' => $expiryDate,
        ':amounts' => $amounts,
        ':cvv' => $cvv
    ]);

    // Redirection après insertion
    echo  '<script>alert("✅ Paiement effectué avec succès.");</script>';
    header("Location: client.php");
    exit();
} else {
    // Si on arrive ici sans POST, on redirige
    echo  '<script>alert("❌ Une erreur est survenue lors du paiement.");</script>';
    header("Location: reservation.php");
    exit();
}
