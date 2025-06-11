<?php
session_start(); 
include './includes/db.php';


$client_id = 1;


$sql = "SELECT r.*, h.nom_hotel, h.ville, c.type_chambre, c.prix
        FROM reservations r
        JOIN hotels h ON r.hotel_id = h.id_hotel
        JOIN chambres c ON r.chambre_id = c.id_chambre
        WHERE r.client_id = :client_id
        ORDER BY r.date_arrivee DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute(['client_id' => $client_id]);
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">📅 Mes Réservations</h2>

    <?php if (count($reservations) === 0): ?>
        <div class="alert alert-info">Vous n'avez aucune réservation pour le moment.</div>
    <?php else: ?>
        <div class="table-responsive">
           <?php
include './includes/db.php';

// Remplacer 1 par l'ID réel du client connecté
$client_id = 1;

$sql = "SELECT r.*, h.nom_hotel, c.type_chambre
        FROM reservations r
        JOIN hotels h ON r.hotel_id = h.id_hotel
        JOIN chambres c ON r.chambre_id = c.id_chambre
        WHERE r.client_id = :client_id
        ORDER BY r.id_reservation DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':client_id' => $client_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

        </div>
    <?php endif; ?>
</div>
</body>
</html>
