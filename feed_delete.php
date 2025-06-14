<?php
include './includes/db.php';
if (isset($_GET['id'])) {
  $stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
  $stmt->execute([$_GET['id']]);
}

header("Location: messages.php");
exit;
?>