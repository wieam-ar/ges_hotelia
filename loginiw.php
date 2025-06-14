<?php
session_start();
include './includes/db.php';



if (isset($_SESSION['success'])) {
    echo "<script>alert('" . addslashes($_SESSION['success']) . "');</script>";
    unset($_SESSION['success']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!$email || !$password) {
       echo "<script>alert('Remplissez tous les champs.')</script>";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Connecté
            $_SESSION['id_client'] = $user['id_client'];
            $_SESSION['client_nom'] = $user['nom'];
            $_SESSION['client_email'] = $user['email'];
            $_SESSION['telephone'] = $user['telephone'];
            $_SESSION['client_adresse'] = $user['adresse'];

            header('Location: index.php');
            exit();
        } else {
             echo "<script>alert('Email ou mot de passe incorrect.')</script>";
            
        }
    }
}
?>