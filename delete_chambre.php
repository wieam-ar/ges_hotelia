<?php
include './includes/db.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM chambres WHERE id_chambre = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: admin.php");
exit;
