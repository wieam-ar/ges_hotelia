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
    <title>Réservation d'Hôtel - Hôtelia.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Your existing styles go here (same as before) */
        #room-selection,
        #payment-section {
            display: none;
        }

        :root {

            --primary-color: rgb(255, 123, 0);
            --secondary-color: rgb(0, 0, 0);
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

        /* Payment Methods - Fixed Version */
        .payment-methods {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            /* For mobile responsiveness */
        }

        .payment-method-option {
            position: relative;
        }

        .payment-method-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .payment-method-option label {
            cursor: pointer;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            padding: 12px 24px;
            border: 2px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease;
            user-select: none;
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            min-width: 120px;
            justify-content: center;
        }

        .payment-method-option label:hover {
            border-color: #ff7b00;
            background-color: #fff5f0;
            transform: translateY(-2px);
        }

        .payment-method-option input[type="radio"]:checked+label {
            border-color: #ff7b00;
            background-color: #ff7b00;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 123, 0, 0.3);
        }

        .payment-method-option input[type="radio"]:focus+label {
            outline: 2px solid #ff7b00;
            outline-offset: 2px;
        }

        /* Card icons */
        .payment-method-option label i {
            font-size: 1.2rem;
        }

        /* Form section styling */
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(248, 250, 252, 0.8);
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .section-title {
            color: #1e293b;
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: #ff7b00;
            font-size: 1.25rem;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .payment-methods {
                flex-direction: column;
                align-items: center;
            }

            .payment-method-option label {
                min-width: 200px;
            }
        }
    </style>
</head>

<body style="background-color: black;">

    <section id="section" class="py-5">
        <div class="container">
            <!-- Progress Bar -->
            <div class="progress mb-4 rounded-pill" style="height: 10px;">
                <div class="progress-bar bg-warning" id="progress" style="width: 33%;"></div>
            </div>

            <!-- Steps -->
            <div class="row m-4 p-3 text-white">
                <div class="col-md-4 text-center">
                    <i class="fas fa-hotel text-warning me-2"></i>Choisir un Hôtel
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-bed text-warning me-2"></i>Sélectionner les Chambres
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-credit-card text-warning me-2"></i>Paiement
                </div>
            </div>

            <!-- Hotels Display -->
            <div id="hotels-list">
                <?php if (count($hotels) === 0): ?>
                    <p class="text-warning">Aucun hôtel trouvé avec ces critères.</p>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($hotels as $hotel): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card border-0 shadow-lg h-100 overflow-hidden">
                                    <img src="uploads/<?php echo htmlspecialchars($hotel['image']); ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                                    <div class="card-body bg-white text-dark">
                                        <h5 class="card-title fw-bold"><?php echo htmlspecialchars($hotel['nom_hotel']); ?></h5>
                                        <p><?php echo htmlspecialchars($hotel['ville']); ?></p>

                                        <p class="card-text"><?= htmlspecialchars($hotel['description']) ?></p>
                                        <a href="#" onclick='showRooms(<?php echo $hotel["id_hotel"]; ?>, "<?php echo addslashes(htmlspecialchars($hotel["nom_hotel"])); ?>")' class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                            <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-5">
                <a href="index.php" class="btn btn-secondary">← Retour à l'accueil</a>
            </div>
        </div>
    </section>

    <!-- Step 2: Room Selection -->
    <section id="room-selection" class="mb-5 container">
        <h2 class="display-4 fw-bold text-center" style="color: white;">2. Choisissez vos Chambres pour <span id="selected-hotel-name"></span></h2>
        <div class="row" id="room-list">
            <?php foreach ($rooms as $room): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 overflow-hidden">
                        <img src="./pictures/chambre1.jpg" class="card-img-top" style="height: 220px; object-fit: cover;">
                        <div class="card-body bg-white text-dark">
                            <h5 class="card-title"><?= htmlspecialchars($room['type_chambre']) ?></h5>
                            <p><i class="fas fa-bed me-2"></i><?= htmlspecialchars($room['nombre_lits']) ?> lit(s)</p>
                            <p><i class="fas fa-layer-group me-2"></i>Étage: <?= htmlspecialchars($room['floor']) ?></p>
                            <p><?= htmlspecialchars($room['discription']) ?></p>
                            <p class="fw-bold"><?= htmlspecialchars($room['prix']) ?> DH / nuit</p>
                            <a href="#" onclick="showPayment()" class="btn btn-outline-dark w-100 mt-2 rounded-5">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-secondary" onclick="backToHotels()">← Retour aux Hôtels</button>
        </div>
    </section>

    <!-- Step 3: Payment Section -->
    <section id="payment-section" class="container my-5">
        <div class="payment-container mx-auto">
            <h2 class="text-center mb-4">Choisir le Moyen de Paiement</h2>
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
                        <div class="invalid-feedback" id="cardNumber-error">Veuillez entrer un numéro valide.</div>
                    </div>

                    <div class="mb-3">
                        <label for="cardHolder" class="form-label">Nom du titulaire <span class="text-warning">*</span></label>
                        <input type="text" class="form-control" id="cardHolder" name="cardHolder"
                            placeholder="AHMED ELBOUDRAI" required style="text-transform: uppercase;">
                        <div class="invalid-feedback" id="cardHolder-error">Ce champ est requis.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="expiryDate" class="form-label">Date d'expiration <span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                placeholder="MM/AA" maxlength="5" required>
                            <div class="invalid-feedback" id="expiryDate-error">Format MM/AA requis.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV <span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="cvv" name="cvv"
                                placeholder="123" maxlength="4" required>
                            <div class="invalid-feedback" id="cvv-error">Code à 3 ou 4 chiffres.</div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="section-title">
                            <i class="bi bi-currency-dollar"></i>
                            Montant à Payer
                        </h5>
                        <div class="mb-3">
                            <label for="amounts" class="form-label">Montant (en Dhs) <span class="text-warning">*</span></label>
                            <input type="number" class="form-control" id="amounts" name="amounts" placeholder="ex: 500" min="1" required>
                            <div class="invalid-feedback" id="amounts-error">Entrez un montant valide.</div>
                        </div>
                    </div>
                </div>

                <!-- Badge de sécurité -->
                <div class="security-badge text-center mb-4">
                    <i class="bi bi-shield-check fs-3 mb-2"></i>
                    <div><strong>Paiement 100% Sécurisé</strong></div>
                    <div>Vos données sont protégées par cryptage SSL</div>
                </div>

                <!-- Bouton de paiement -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-pay w-100">
                        <i class="bi bi-lock"></i>
                        Payer maintenant
                    </button>
                </div>
            </form>

            <!-- Retour aux chambres -->
            <div class="text-center mt-4">
                <button type="button" class="btn btn-secondary" onclick="backToRooms()">← Retour aux Chambres</button>
            </div>
        </div>
    </section>

    <script>
        function showRooms(hotelId, hotelName) {
            document.getElementById('hotels-list').style.display = 'none';
            document.getElementById('room-selection').style.display = 'block';
            document.getElementById('payment-section').style.display = 'none';
            document.getElementById('selected-hotel-name').innerText = hotelName;
            document.getElementById('progress').style.width = '66%';
        }

        function showPayment() {
            document.getElementById('room-selection').style.display = 'none';
            document.getElementById('payment-section').style.display = 'block';
            document.getElementById('progress').style.width = '100%';
        }

        function backToHotels() {
            document.getElementById('room-selection').style.display = 'none';
            document.getElementById('payment-section').style.display = 'none';
            document.getElementById('hotels-list').style.display = 'block';
            document.getElementById('progress').style.width = '33%';
        }

        function backToRooms() {
            document.getElementById('payment-section').style.display = 'none';
            document.getElementById('room-selection').style.display = 'block';
            document.getElementById('progress').style.width = '66%';
        }
    </script>

</body>

</html>