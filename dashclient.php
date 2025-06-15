<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f5f0;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .page-title {
            font-size: 2rem;
            text-align: center;
            color: #b08968;
            margin-bottom: 30px;
        }

        .page-title i {
            margin-right: 10px;
            color: #d4a373;
        }

        .reservation-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 25px;
        }

        .hotel-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #6b4c3b;
        }

        .hotel-name i {
            margin-right: 8px;
            color: #b08968;
        }

        .luxury-badge {
            background: #f0e5cf;
            color: #b08968;
            padding: 4px 10px;
            margin-left: 10px;
            border-radius: 8px;
            font-size: 0.85rem;
        }

        .reservation-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: #faf6f0;
            padding: 10px;
            border-radius: 10px;
        }

        .detail-label {
            font-weight: 600;
            color: #6b4c3b;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .detail-label i {
            margin-right: 5px;
        }

        .detail-value {
            font-size: 0.95rem;
        }

        .price-highlight {
            background: #fff4e6;
            border: 2px solid #f0c987;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-modify {
            background-color: #ffe8cc;
            color: #6b4c3b;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-modify:hover {
            background-color: #ffd8a8;
        }

        .btn-delete {
            background-color: #ffe0e0;
            color: #a80000;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-delete:hover {
            background-color: #ffb3b3;
        }

        .empty-state {
            text-align: center;
            margin-top: 40px;
            padding: 30px;
            background-color: #fff;
            border: 2px dashed #ddd;
            border-radius: 15px;
            color: #777;
            display: none;
        }

        .empty-state i {
            font-size: 2.5rem;
            color: #ccc;
            margin-bottom: 10px;
        }

        @media (min-width: 768px) {
            .reservation-details {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    </style>
</head>
<body>

    <?php include 'includes/sideclient.php'; ?>

    <div class="dashboard">
        <h1 class="page-title">
            <i class="fas fa-calendar-check"></i>
            Mes Réservations
        </h1>

        <div class="reservations-grid">
            <!-- Réservation 1 -->
            <div class="reservation-card">
                <div class="hotel-name">
                    <i class="fas fa-hotel"></i> Hôtel Majestic
                    <span class="luxury-badge">Deluxe</span>
                </div>

                <div class="reservation-details">
                    <div class="detail-item">
                        <div class="detail-label"><i class="fas fa-calendar-plus"></i> Arrivée</div>
                        <div class="detail-value">20 Juin 2025</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label"><i class="fas fa-calendar-minus"></i> Départ</div>
                        <div class="detail-value">24 Juin 2025</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label"><i class="fas fa-users"></i> Personnes</div>
                        <div class="detail-value">2 Adultes</div>
                    </div>
                    <div class="detail-item price-highlight">
                        <div class="detail-label"><i class="fas fa-tag"></i> Prix Total</div>
                        <div class="detail-value">1 800 MAD</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn-modify"><i class="fas fa-edit"></i> Modifier</button>
                    <button class="btn-delete"><i class="fas fa-trash"></i> Supprimer</button>
                </div>
            </div>

            <!-- Réservation 2 -->
            <div class="reservation-card">
                <div class="hotel-name">
                    <i class="fas fa-hotel"></i> Hôtel Atlas
                    <span class="luxury-badge">Suite Vue Mer</span>
                </div>

                <div class="reservation-details">
                    <div class="detail-item">
                        <div class="detail-label"><i class="fas fa-calendar-plus"></i> Arrivée</div>
                        <div class="detail-value">01 Juillet 2025</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label"><i class="fas fa-calendar-minus"></i> Départ</div>
                        <div class="detail-value">05 Juillet 2025</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label"><i class="fas fa-users"></i> Personnes</div>
                        <div class="detail-value">3 Adultes</div>
                    </div>
                    <div class="detail-item price-highlight">
                        <div class="detail-label"><i class="fas fa-tag"></i> Prix Total</div>
                        <div class="detail-value">3 200 MAD</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn-modify" onclick="modifyReservation(2)">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="btn-delete" onclick="deleteReservation(2)">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        </div>

        <!-- État vide -->
        <div class="empty-state" id="emptyState">
            <i class="fas fa-calendar-times"></i>
            <h3>Aucune réservation trouvée</h3>
            <p>Vous n'avez actuellement aucune réservation. Explorez nos hôtels pour planifier votre prochain séjour !</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
