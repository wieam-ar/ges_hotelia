<?php
session_start();
include './includes/db.php';

if (!isset($_SESSION['id_client'])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>prifile</title>
    <style>
   
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: rgb(255, 255, 255) ;
            min-height: 100vh;
            position: relative;
        }

        /* Effet décoratif d'arrière-plan */
        .profile-container::before {
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

        /* Main Profile Card */
        .profile-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow:
                0 15px 35px rgba(93, 78, 55, 0.12),
                0 5px 15px rgb(136, 123, 108) ;
            margin-bottom: 30px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid rgb(136, 123, 108) ;
            position: relative;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgb(136, 123, 108) ;
        }

        .profile-card:hover {
            transform: translateY(-8px);
            box-shadow:
                0 20px 40px rgba(93, 78, 55, 0.15),
                0 8px 20px rgb(136, 123, 108) ;
        }

        /* Profile Header */
        .profile-header {
            background: rgb(136, 123, 108) ;
            color: white;
            padding: 45px 35px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%),
                linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
            animation: headerShimmer 4s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes headerShimmer {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
                opacity: 0.7;
            }

            50% {
                transform: rotate(180deg) scale(1.1);
                opacity: 1;
            }
        }

        .profile-avatar {
            font-size: 4.5rem;
            margin-bottom: 20px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 120px;
            height: 120px;
            line-height: 120px;
            backdrop-filter: blur(10px);
            border: 3px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .profile-header h2 {
            margin: 0 0 15px 0;
            font-size: 2.4rem;
            font-weight: 700;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 2;
        }

        .profile-header p {
            margin: 0;
            font-size: 1.2rem;
            opacity: 0.95;
            font-weight: 400;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 2;
        }

        /* Profile Body */
        .profile-body {
            padding: 35px;
            background: linear-gradient(145deg, #ffffff 0%, rgb(235, 235, 235)  100%);
        }

        /* Success Alert */
        .alert {
            padding: 18px 24px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(45deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 5px solid var(--accent-gold);
            position: relative;
            overflow: hidden;
        }

        .alert-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            animation: alertShine 2s ease-in-out infinite;
        }

        @keyframes alertShine {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .alert i {
            margin-right: 12px;
            font-size: 1.2rem;
            color: var(--accent-gold);
        }

        /* Profile Information */
        .profile-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 25px 20px;
            border-bottom: 1px solid var(--border-beige);
            transition: all 0.3s ease;
            border-radius: 10px;
            margin-bottom: 5px;
            position: relative;
        }

        .profile-info::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-gold);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 2px;
        }

        .profile-info:hover {
            background: var(--gradient-beige);
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(93, 78, 55, 0.08);
        }

        .profile-info:hover::before {
            transform: scaleY(1);
        }

        .profile-info:last-of-type {
            border-bottom: none;
        }

        .profile-info strong {
            color: var(--text-dark);
            font-weight: 700;
            display: flex;
            align-items: center;
            min-width: 180px;
            font-size: 1rem;
        }

        .profile-info strong i {
            margin-right: 12px;
            color: var(--accent-gold);
            font-size: 1.3rem;
            background: rgba(212, 175, 55, 0.1);
            padding: 10px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .profile-info:hover strong i {
            background: var(--accent-gold);
            color: white;
            transform: scale(1.1);
        }

        .profile-info span {
            color: var(--text-medium);
            font-weight: 600;
            flex-grow: 1;
            text-align: right;
            font-size: 1rem;
        }

        /* Badge Styling */
        .badge {
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            position: relative;
            overflow: hidden;
        }

        .bg-success {
            background: var(--gradient-gold) !important;
            color: white;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .bg-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .bg-success:hover::before {
            left: 100%;
        }

        /* Action Buttons */
        .action-buttons {
            margin-top: 35px;
            text-align: center;
            padding-top: 20px;
            border-top: 2px solid var(--border-beige);
        }

        .btn {
            display: inline-block;
            padding: 16px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.4s ease;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-edit {
            background: linear-gradient(135deg, #e6c147 0%, #d4af37 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .btn-edit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
             background: linear-gradient(135deg, #e6c147 0%, #d4af37 100%);
            transition: left 0.5s;
        }

        .btn-edit:hover::before {
            left: 100%;
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.6);
            color: white;
            text-decoration: none;
            background: linear-gradient(135deg, #e6c147 0%, #d4af37 100%);
        }

        .btn-edit:active {
            transform: translateY(-1px);
        }

        .btn-edit i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Animation d'apparition */
        .profile-card {
            animation: slideInFromBottom 0.8s ease-out;
        }

        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-container {
                padding: 15px;
            }

            .profile-header {
                padding: 35px 25px;
            }

            .profile-header h2 {
                font-size: 2rem;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                line-height: 100px;
                font-size: 3.5rem;
            }

            .profile-body {
                padding: 25px 20px;
            }

            .profile-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 20px 15px;
            }

            .profile-info span {
                text-align: left;
                font-size: 0.95rem;
            }

            .profile-info strong {
                min-width: auto;
                font-size: 0.95rem;
            }

            .btn-edit {
                padding: 14px 25px;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
            }
        }

        @media (max-width: 480px) {
            .profile-header h2 {
                font-size: 1.7rem;
            }

            .profile-header p {
                font-size: 1rem;
            }

            .profile-info:hover {
                transform: translateX(5px);
            }

            .badge {
                padding: 8px 16px;
                font-size: 0.8rem;
            }
        }

        /* Amélioration de l'accessibilité */
        .btn:focus-visible {
            outline: 3px solid var(--text-dark);
            outline-offset: 3px;
        }

        .profile-info:focus-within {
            background: var(--gradient-beige);
            outline: 2px solid var(--accent-gold);
            outline-offset: 2px;
        }

        /* Micro-interactions */
        .profile-info strong i {
            animation: iconPulse 2s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }
    </style>
</head>


<body>
    <?php  include './includes/sideclient.php';?>
    <div class="profile-container">
        <!-- Carte de profil principale -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    👤
                </div>
                <h2 id="displayName">Bienvenue, <?= htmlspecialchars($_SESSION['client_nom']) ?> 👋</h2>
                <p>Votre espace client personnel</p>
            </div>
            <div class="profile-body">
                <div id="successAlert" class="alert alert-success" style="display: none;">
                    <i class="bi bi-check-circle-fill"></i> Vos informations ont été mises à jour avec succès !
                </div>
                <div class="profile-info">
                    <strong><i class="bi bi-geo-alt"></i> Adresse :</strong>
                    <span id="displaynom"><?= htmlspecialchars($_SESSION['client_nom']) ?></span>
                </div>
                <div class="profile-info">
                    <strong><i class="bi bi-envelope"></i> Email :</strong>
                    <span id="displayEmail"><?= htmlspecialchars($_SESSION['client_email']) ?></span>
                </div>

                <div class="profile-info">
                    <strong><i class="bi bi-telephone"></i> Téléphone :</strong>
                    <span id="displayPhone"><?= htmlspecialchars($_SESSION['telephone']) ?></span>
                </div>

                <div class="profile-info">
                    <strong><i class="bi bi-geo-alt"></i> Adresse :</strong>
                    <span id="displayAddress"><?= htmlspecialchars($_SESSION['client_adresse']) ?></span>
                </div>

                <div class="profile-info">
                    <strong><i class="bi bi-shield-check"></i> Statut :</strong>
                    <span id="displayStatus" class="badge bg-success">Client Actif</span>
                </div>

                <div class="action-buttons">
                    <a href="infomodify.php" class="btn btn-edit">
                        <i class="bi bi-pencil-square"></i> Modifier mes informations
                    </a>

                </div>
            </div>
        </div>



    </div>
    <!-- =========== Scripts =========  -->
    <script src="./javascript/admin.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>