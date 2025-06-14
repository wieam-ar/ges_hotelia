
<?php
include './includes/db.php';
session_start();

// Get filter values safely (from GET)
$location = isset($_GET['ville']) ? $_GET['ville'] : '';
$date_arrivee = isset($_GET['date_arrivee']) ? $_GET['date_arrivee'] : '';
$date_depart = isset($_GET['date_depart']) ? $_GET['date_depart'] : '';
$personnes = isset($_GET['personnes']) ? (int)$_GET['personnes'] : 1;

// Prepare hotels query
if ($location !== '') {
    $stmt = $pdo->prepare("SELECT * FROM hotels WHERE ville LIKE ? ORDER BY id_hotel DESC");
    $stmt->execute(["%$location%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM hotels ORDER BY id_hotel DESC");
}
$hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get all rooms (chambres)
$stmt2 = $pdo->query("SELECT * FROM chambres ORDER BY id_chambre DESC");
$rooms = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation d'Hôtel - Hôtelia.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./styles/reservation.css">
    <style>
        :root {

            --primary-color: rgb(255, 123, 0);
            --secondary-color: #f8fafc;
            --accent-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

            --border-radius: 12px;
            --border-radius-lg: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Payment Section */
        #payment-section {
            min-height: 100vh;
            background: black;
            position: relative;
            overflow: hidden;
        }


        /* Payment Container */
        .payment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            margin: 2rem;
            position: relative;
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

        .payment-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0;
        }

        /* Typography */
        .payment-container h2 {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .payment-container h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 2.5rem;
            padding: 1.5rem;
            background: rgba(248, 250, 252, 0.6);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .form-section:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .section-title {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        /* Payment Methods */
        .payment-methods {
            display: flex;
            gap: 20px;
            /* مسافة بين الخيارات */
            justify-content: center;
            /* توسيط أفقي */
            margin-bottom: 20px;
        }

        .payment-methods label {
            cursor: pointer;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            padding: 8px 16px;
            border: 2px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease;
            user-select: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* تنسيق زر الراديو (hidden) */
        .payment-methods input[type="radio"] {
            accent-color: rgb(255, 143, 37);
            /* لون أزرق عصري */
        }

        /* لما يكون الخيار محدد */
        .payment-methods input[type="radio"]:checked+label,
        .payment-methods label:hover {
            border-color: rgb(255, 251, 0);
            color: rgb(0, 0, 0);
            background-color: #e7f1ff;
        }


        /* Form Controls */
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .text-warning {
            color: var(--warning-color) !important;
        }

        .form-control,
        .form-select {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            color: var(--text-primary);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-control.is-valid {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Input Groups */
        .input-group-text {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: 2px solid var(--primary-color);
            color: white;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }

        .input-group .form-control:focus {
            border-left: 2px solid var(--primary-color);
        }

        /* Security Badge */
        .security-badge {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            border: 2px solid rgba(16, 185, 129, 0.2);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .security-badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            animation: securityPulse 3s ease-in-out infinite;
        }

        @keyframes securityPulse {

            0%,
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
        }

        .security-badge i {
            color: var(--accent-color);
            animation: securityShield 2s ease-in-out infinite;
        }

        @keyframes securityShield {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .security-badge strong {
            color: var(--accent-color);
            font-weight: 700;
        }

        .security-badge div:last-child {
            color: var(--text-secondary);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Payment Button */
        .btn-pay {
            background: yellow;
            border: none;
            color: white;
            font-weight: 600;
            font-size: 1.125rem;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .btn-pay::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 151, 14, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-pay:hover::before {
            left: 100%;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: linear-gradient(135deg, #ff780a 0%, #f1c945 100%);
        }

        .btn-pay:active {
            transform: translateY(0);
            box-shadow: var(--shadow-md);
        }

        .btn-pay i {
            margin-right: 0.5rem;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }

            .payment-container h2 {
                font-size: 1.5rem;
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }

            .form-section {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .payment-container {
                padding: 1.5rem 1rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .payment-method {
                padding: 1rem;
            }

            .payment-method i {
                font-size: 1.5rem;
            }
        }

        /* Loading States */
        .btn-pay.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-pay.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Success State */
        .form-control.success {
            border-color: var(--accent-color);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310b981' d='m2.3 6.73.94-.94 4.94-4.94L6.77 0 2.3 4.47 1.53 3.7 0 5.23l2.3 1.5z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        /* Smooth Transitions */
        * {
            transition: var(--transition);
        }

        /* Focus Visible */
        .payment-method:focus-visible,
        .btn-pay:focus-visible,
        .form-control:focus-visible,
        .form-select:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

</head>

<body>
    <section id="section" class="py-5">
        <div class="container">

            <!-- Heading -->
            <div class="row mb-5">
                <div class="col-12 text-center text-white">
                    <h2 class="display-4 fw-bold">Réserver Maintenant</h2>
                    <p class="lead">Trouvez votre hébergement de rêve au meilleur prix</p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar bg-secondary mb-4 rounded-pill" style="height: 10px;">
                <div class="progress bg-warning" id="progress" style="width: 33%; height: 100%;"></div>
            </div>

            <!-- Steps -->
            <div class="row m-4 p-3">
                <div class="col-md-4 text-center">
                    <div class="step active">
                        <div class="step-icon"><i class="fas fa-hotel" style="color: GOLD;"></i></div>
                        <div class="step-text text-light">Choisir un Hôtel</div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="step">
                        <div class="step-icon"><i class="fas fa-bed" style="color: GOLD;"></i></div>
                        <div class="step-text text-light">Sélectionner les Chambres</div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="step">
                        <div class="step-icon"><i class="fas fa-credit-card" style="color: GOLD;"></i></div>
                        <div class="step-text text-light">Paiement</div>
                    </div>
                </div>
            </div>

            <!-- Hotels Display -->
            <div class="row" id="hotels-list">
                <?php if (count($hotels) === 0): ?>
                    <p class="text-warning">Aucun hôtel trouvé avec ces critères.</p>
                <?php else: ?>
                    <?php foreach ($hotels as $hotel): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-0 shadow-lg h-100 overflow-hidden">
                                <div class="card-img-container position-relative">
                                    <img src="uploads/<?php echo htmlspecialchars($hotel['image']); ?>" class="card-img-top" style="height: 220px; object-fit: cover;">

                                </div>
                                <div class="card-body bg-white text-dark">
                                    <h5 class="card-title fw-bold"><?php echo htmlspecialchars($hotel['nom_hotel']); ?></h5>
                                    <div class="position d-flex justify-content-between">
                                        <div class="star-rating mb-2">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                            <span class="ms-2 text-muted">(4.5)</span>
                                        </div>

                                        <div class="amenities mb-2">
                                            <i class="fas fa-wifi amenity-icon me-2" title="WiFi gratuit"></i>
                                            <i class="fas fa-swimming-pool amenity-icon me-2" title="Piscine"></i>
                                            <i class="fas fa-car amenity-icon me-2" title="Parking"></i>
                                            <i class="fas fa-utensils amenity-icon me-2" title="Restaurant"></i>
                                        </div>
                                    </div>

                                    <p class="card-text"><?php echo htmlspecialchars($hotel['ville']); ?></p>
                                    <p class="card-text text-ce"><?php echo htmlspecialchars($hotel['description']); ?></p>

                                    `<a href="reservation.php?step=2&id_hotel=<?php echo $hotel['id_hotel']; ?>&date_arrivee=<?php echo urlencode($date_arrivee); ?>&date_depart=<?php echo urlencode($date_depart); ?>&nb_personnes=<?php echo $personnes; ?>" class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                        <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                                    </a>`
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Back Button -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="index.php" class="btn btn-explore-more rounded-5 pt-3 pb-3 px-4">
                    <span class="btn-text"><i class="fas fa-compass me-2"></i>RETOUR</span>
                </a>
            </div>
        </div>
        </div>
    </section>
    <!-- Step 2: Room Selection -->
    <?php
    include './includes/db.php';

    $id_hotel = $_GET['id_hotel'] ?? null;

    if ($id_hotel) {
        $stmt = $pdo->prepare("SELECT * FROM chambres WHERE id_hotel = ? ORDER BY id_chambre DESC");
        $stmt->execute([$id_hotel]);
        $chambres = $stmt->fetchAll();
    } else {
        echo "<p class='text-danger'>Aucun hôtel sélectionné.</p>";
        exit;
    }
    ?>

    <section id="room-selection" class="mb-5">
        <h2 class="display-4 fw-bold text-center">2. Choisissez vos Chambres pour <span id="selected-hotel-name"></span></h2>
        <div class="row" id="room-list">
            <?php
            include './includes/db.php';
            $chambres = $pdo->query("SELECT * FROM chambres ORDER BY id_chambre DESC LIMIT 4")->fetchAll();
            ?>
            <?php foreach ($chambres as $chambre): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden">
                        <div class="card-body bg-white text-dark">
                            <div class="card-img-container position-relative">
                                <img src="./pictures/chambre1.jpg" class="card-img-top" style="height: 220px; object-fit: cover;">
                            </div>
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($chambre['type_chambre']) ?></h5>
                            <div class="amenities mb-2">
                                <i class="fas fa-bed me-2"></i><?= htmlspecialchars($chambre['nombre_lits']) ?> lits<br>
                                <i class="fas fa-layer-group me-2"></i>Étage: <?= htmlspecialchars($chambre['floor']) ?>
                            </div>
                            <p><?= htmlspecialchars($chambre['discription']) ?></p>
                            <p class="fw-semibold mt-2">Prix: <?= htmlspecialchars($chambre['prix']) ?> DH / nuit</p>
                            <a href="reservation.php?step=3&id_chambre=<?= $chambre['id_chambre'] ?>&id_hotel=<?= $id_hotel ?>" class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="text-center mt-4">
            <button class="btn btn-secondary" id="back-to-hotels" style="margin: 0;">Retour aux Hôtels</button>
        </div>
    </section>


    <!-- Step 3: Payment -->

    <section id="payment-section" class=" d-flex justify-content-center align-items-center d-none mb-5">
        <div class="payment-container ">
            <h2 class="text-center mb-4">Choose Payment Method</h2>
            <form action="card_vm.php" method="post" id="paymentForm">

                <!-- Méthodes de paiement -->
                <div class="form-section">
                    <h5 class="section-title">
                        <i class="bi bi-credit-card-2-front"></i>
                        Méthode de Paiement
                    </h5>

                    <div class="payment-methods">
                        <label><input type="radio" name="paymentMethod" value="visa" checked> Visa</label>
                        <label><input type="radio" name="paymentMethod" value="mastercard"> Mastercard</label>

                    </div>
                </div>

                <!-- Informations de la carte -->
                <div class="form-section" id="cardSection">
                    <h5 class="section-title">
                        <i class="bi bi-shield-lock"></i>
                        Informations de la Carte
                    </h5>
                   
                    <div class="mb-3">
                       
                        <label for="cardNumber" class="form-label">Numéro de carte <span class="text-warning">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                                placeholder="1234 5678 9012 3456" maxlength="19" required>
                        </div>
                        <div class="invalid-feedback" id="cardNumber-error"></div>
                    </div>


                    <div class="mb-3">
                        <label for="cardHolder" class="form-label">Nom du titulaire <span class="text-warning">*</span></label>
                        <input type="text" class="form-control" id="cardHolder" name="cardHolder"
                            placeholder="yahya tariki" required style="text-transform: uppercase;">
                        <div class="invalid-feedback" id="cardHolder-error"></div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="expiryDate" class="form-label">Date d'expiration <span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                placeholder="MM/AA" maxlength="5" required>
                            <div class="invalid-feedback" id="expiryDate-error"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV <span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="cvv" name="cvv"
                                placeholder="123" maxlength="4" required>
                            <div class="invalid-feedback" id="cvv-error"></div>
                        </div>
                    </div>
                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="bi bi-currency-dollar"></i>
                            Montant à Payer
                            <?php

                            ?>
                        </h5>

                        <div class="mb-3">
                            <label for="amounts" class="form-label">Montant (en Dhs) <span class="text-warning">*</span></label>
                            <input type="number" class="form-control" id="amounts" name="amounts" placeholder="ex: 500" min="1" required>
                            <div class="invalid-feedback" id="amounts-error"></div>
                        </div>
                    </div>
                </div>


                <!-- Badge de sécurité -->
                <div class="security-badge">
                    <i class="bi bi-shield-check fs-3 mb-2"></i>
                    <div><strong>Paiement 100% Sécurisé</strong></div>
                    <div>Vos données sont protégées par cryptage SSL</div>
                </div>

                <!-- Bouton de paiement -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-pay">
                        <i class="bi bi-lock"></i>
                        Payer maintenant
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        const steps = document.querySelectorAll(".step");
        const progress = document.getElementById("progress");

        const sectionHotel = document.getElementById("section");
        const sectionRoom = document.getElementById("room-selection");
        const sectionPayment = document.getElementById("payment-section");

        function goToStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle("active", i <= index);
            });

            const percent = index / (steps.length - 1) * 100;
            progress.style.width = percent + "%";

            sectionHotel.classList.toggle("d-none", index !== 0);
            sectionRoom.classList.toggle("d-none", index !== 1);
            sectionPayment.classList.toggle("d-none", index !== 2);
        }

        // Step Buttons
        steps.forEach((step, index) => {
            step.addEventListener("click", () => {
                goToStep(index);
            });
        });

        document.getElementById("back-to-hotels").addEventListener("click", () => {
            goToStep(0);
        });

        document.getElementById("proceed-to-payment").addEventListener("click", () => {
            goToStep(2);
        });

        // Sélection des méthodes de paiement (par ex. Carte, PayPal, etc.)
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                // Supprimer la classe "active" de toutes les méthodes
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));

                // Ajouter "active" à l'élément sélectionné
                this.classList.add('active');

                // Afficher ou masquer la section carte selon la méthode sélectionnée
                const cardSection = document.getElementById('cardSection');
                const selectedMethod = this.dataset.method;


            });
        });
    </script>


    <!-- footer -->
    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./reservation.js"></script> <!-- Fichier JavaScript personnalisé -->
</body>

</html>