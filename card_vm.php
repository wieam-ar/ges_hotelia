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

    // Vérifier que les champs ne sont pas vides (validation simple)
    if (!$method || !$cardNumber || !$cardHolder || !$expiryDate || !$cvv || !$amounts) {
        die("Tous les champs sont obligatoires.");
    }

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
?>