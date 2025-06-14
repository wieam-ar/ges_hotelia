<?php
session_start();
    include './includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
    $stmt->execute([$email]);
    $client = $stmt->fetch();
   if ($user && password_verify($password, $user['password'])) {
        // login successful
        $_SESSION['id_client'] = $user['id_client'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['email'] = $user['email'];
        header("Location: info.php"); 
        exit();
    } else {
        $login_error = "Email ou mot de passe incorrect.";
    }
}
