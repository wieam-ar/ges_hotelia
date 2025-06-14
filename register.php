<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $adresse = trim($_POST["adresse"]);
    $telephone = trim($_POST["telephone"]);
    $password = $_POST["password"];

    // Vérification des champs
    if (!$nom || !$email || !$password || !$adresse || !$telephone) {
        echo "<script>alert('🚫 Tous les champs sont obligatoires.'); window.history.back();</script>";
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('🚫 Email invalide.'); window.history.back();</script>";
        exit();
    } else {
        // Vérifier si email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('🚫 Cet email est déjà utilisé.'); window.history.back();</script>";
            exit();
        } else {
            // Hasher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $stmt = $pdo->prepare("
                INSERT INTO clients (nom, email, adresse, telephone, password)
                VALUES (:nom, :email, :adresse, :telephone, :password)
            ");
            $stmt->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':adresse' => $adresse,
                ':telephone' => $telephone,
                ':password' => $hashedPassword
            ]);

            // Redirection après succès
            $_SESSION['success'] = "✅ Inscription réussie ! Vous pouvez vous connecter.";
            header('Location: login.php');
            exit();
        }
    }
}
?>
