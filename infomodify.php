<?php
session_start();
include './includes/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $adresse = trim($_POST["adresse"]);
    $telephone = trim($_POST["telephone"]);
    

    if (!$nom || !$email ||  !$adresse || !$telephone) {
        echo "<script>alert('Tous les champs doivent être remplis.')/script>";
    } else {
        $sql = "UPDATE clients 
                SET email = :email, telephone = :telephone, adresse = :adresse, code_postal = :code_postal, ville = :ville 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $updated = $stmt->execute([
            ':nom' => $nom,
                ':email' => $email,
                ':adresse' => $adresse,
                ':telephone' => $telephone
                
        ]);

      
    }
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mes Informations Personnelles</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Variables CSS pour la palette beige & or */
        :root {
            --primary-beige: #f5e6d3;
            --secondary-beige: #e8d5c4;
            --accent-gold: #d4af37;
            --dark-gold: #b8941f;
            --light-cream: #faf7f2;
            --warm-beige: #ddc3a5;
            --text-dark: #5d4e37;
            --text-medium: #8b7355;
            --border-beige: #d9c7b7;
            --shadow-warm: rgba(212, 175, 55, 0.15);
            --gradient-gold: linear-gradient(135deg, #d4af37 0%, #f4e4bc 100%);
            --gradient-beige: linear-gradient(135deg, #f5e6d3 0%, #e8d5c4 100%);
        }

        body {
            background: var(--light-cream);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 20%, rgba(212, 175, 55, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(245, 230, 211, 0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px 0;
            background: var(--gradient-gold);
            border-radius: 20px;
            color: white;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: headerShine 4s ease-in-out infinite;
        }

        @keyframes headerShine {

            0%,
            100% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(180deg);
            }
        }

        .page-header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .page-header p {
            margin: 10px 0 0 0;
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .page-header i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        /* Form Container */
        .edit-form {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow:
                0 15px 35px rgba(93, 78, 55, 0.1),
                0 5px 15px rgba(212, 175, 55, 0.08);
            border: 1px solid var(--border-beige);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .edit-form::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.03) 0%, transparent 70%);
            animation: gentleRotate 20s linear infinite;
            pointer-events: none;
        }

        @keyframes gentleRotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Section Headers */
        .section-header {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            font-size: 1.3rem;
            position: relative;
            padding-bottom: 15px;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--gradient-gold);
            border-radius: 2px;
        }

        .section-header i {
            margin-right: 12px;
            color: var(--accent-gold);
            font-size: 1.2rem;
            background: rgba(212, 175, 55, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        /* Form Groups */
        .form-section {
            background: var(--gradient-beige);
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 1px solid var(--border-beige);
        }

        /* Labels */
        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: var(--accent-gold);
            font-size: 1rem;
        }

        /* Form Controls */
        .form-control,
        .form-select {
            border: 2px solid var(--border-beige);
            border-radius: 12px;
            padding: 15px 18px;
            font-size: 1rem;
            background: #ffffff;
            color: var(--text-dark);
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(93, 78, 55, 0.05);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-gold);
            box-shadow:
                0 0 0 0.2rem rgba(212, 175, 55, 0.15),
                inset 0 2px 4px rgba(93, 78, 55, 0.05);
            background: var(--light-cream);
            outline: none;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: var(--warm-beige);
            background: var(--light-cream);
        }

        /* Textarea */
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        /* Checkboxes and Radio */
        .form-check-input {
            border: 2px solid var(--border-beige);
            background: #ffffff;
        }

        .form-check-input:checked {
            background-color: var(--accent-gold);
            border-color: var(--accent-gold);
        }

        .form-check-input:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        .form-check-label {
            color: var(--text-dark);
            font-weight: 500;
            margin-left: 8px;
        }

        /* Buttons */
        .btn {
            padding: 14px 28px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 140px;
            position: relative;
            overflow: hidden;
        }

        .btn i {
            margin-right: 8px;
            font-size: 1rem;
        }

        .btn-save {
            background: var(--gradient-gold);
            color: #ffffff;
            box-shadow:
                0 6px 20px rgba(212, 175, 55, 0.3),
                0 2px 8px rgba(184, 148, 31, 0.2);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .btn-save::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-save:hover::before {
            left: 100%;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow:
                0 8px 25px rgba(212, 175, 55, 0.4),
                0 4px 12px rgba(184, 148, 31, 0.3);
            background: linear-gradient(135deg, #e6c147 0%, #f4e4bc 100%);
        }

        .btn-cancel {
            background: var(--gradient-beige);
            color: var(--text-dark);
            box-shadow:
                0 4px 15px rgba(93, 78, 55, 0.15),
                0 2px 6px rgba(139, 115, 85, 0.1);
            border: 1px solid var(--border-beige);
            margin-right: 15px;
        }

        .btn-cancel:hover {
            background: linear-gradient(135deg, #e8d5c4 0%, #ddc3a5 100%);
            transform: translateY(-2px);
            box-shadow:
                0 6px 20px rgba(93, 78, 55, 0.2),
                0 3px 8px rgba(139, 115, 85, 0.15);
            color: var(--text-dark);
            text-decoration: none;
        }

        .btn-reset {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            background: linear-gradient(135deg, #e74c3c 0%, #dc3545 100%);
        }

        /* Form Buttons Container */
        .form-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
            padding-top: 30px;
            border-top: 2px solid var(--border-beige);
        }

        /* Progress Bar */
        .progress-bar {
            background: var(--gradient-gold);
            height: 6px;
            border-radius: 3px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress-fill {
            background: linear-gradient(90deg, var(--accent-gold), var(--dark-gold));
            height: 100%;
            width: 0%;
            transition: width 0.5s ease;
        }



        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .edit-form {
                padding: 25px 20px;
                margin: 15px 0;
                border-radius: 15px;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .form-section {
                padding: 20px;
            }

            .form-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 250px;
                margin-bottom: 10px;
            }

            .btn-cancel {
                margin-right: 0;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                padding: 20px 15px;
            }

            .page-header h1 {
                font-size: 1.8rem;
            }

            .section-header {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1><i class="bi bi-person-gear"></i> Modification des Données Personnelles</h1>
            <p>Mettez à jour vos informations personnelles en toute sécurité</p>

            <!-- Main Form -->
            <div class="edit-form">
                <!-- Formulaire HTML -->
                <form id="personalDataForm" method="post">
                    <div class="form-section">
                        <h4 class="section-header"><i class="bi bi-telephone"></i> Informations de Contact</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label"><i class="bi bi-envelope"></i> Adresse email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label"><i class="bi bi-phone"></i> Téléphone</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required
                                    value="<?= htmlspecialchars($user['telephone'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h4 class="section-header"><i class="bi bi-geo-alt"></i> Adresse</h4>
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="adresse" class="form-label"><i class="bi bi-house"></i> Adresse complète</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required
                                    value="<?= htmlspecialchars($user['adresse'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="codePostal" class="form-label"><i class="bi bi-mailbox"></i> Code postal</label>
                                <input type="text" class="form-control" id="codePostal" name="codePostal" required
                                    value="<?= htmlspecialchars($user['code_postal'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="ville" class="form-label"><i class="bi bi-building"></i> Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville" required
                                    value="<?= htmlspecialchars($user['ville'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='profile.php'">
                            <i class="bi bi-x-circle"></i> Annuler
                        </button>
                        <button type="reset" class="btn btn-reset">
                            <i class="bi bi-arrow-clockwise"></i> Réinitialiser
                        </button>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check-circle"></i> Sauvegarder
                        </button>
                    </div>
                </form>
            </div>
        </div>


</body>

</html>