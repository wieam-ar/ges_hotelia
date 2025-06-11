<?php
include './includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $password = $_POST["password"];

    $sqlCheck = "SELECT * FROM 	clients WHERE email = :email";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':email' => $email]);

    if ($stmtCheck->rowCount() > 0) {
        echo "<script>alert('🚫 Cet email est déjà utilisé.');</script>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sqlInsert = "INSERT INTO 	clients (nom, email, adresse, telephone, password) VALUES (:nom, :email, :adresse, :telephone, :password)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':adresse' => $adresse,
            ':telephone' => $telephone,
            ':password' => $hashedPassword]);

        echo "<script>alert('✅ Inscription réussie!');</script>";
       header("Location: login.php");
    }
}
?>
