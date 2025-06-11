<?php
include './includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

  
    $stmt = $pdo->prepare("SELECT statut FROM clients WHERE id = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch();

    if ($client) {
        // تغيير الحالة
        $nouveau_statut = ($client['statut'] === 'actif') ? 'banni' : 'actif';

        // تحديث في قاعدة البيانات
        $update = $pdo->prepare("UPDATE clients SET statut = ? WHERE id = ?");
        $update->execute([$nouveau_statut, $id]);
    }
}


header("Location: admin.php");
exit;
?>
