<?php
include './includes/db.php';

$stmt = $pdo->query("SELECT * FROM chambres");
$chambres = $stmt->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --border-radius: 0.5rem;
            --border-radius-lg: 0.75rem;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --transition: all 0.3s ease;
        }

        /* Form Container */
        .form-container {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 2rem;
            margin: 1rem auto;
            max-width: 900px;
            border: 1px solid var(--gray-200);
        }

        /* Section Title */
        .section-title {
            color: var(--gray-800);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            align-items: center;
        }

        .section-title i {
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        /* Form Styling */
        form {
            margin-top: 1.5rem;
        }

        /* Row and Column Spacing */
        .row {
            margin-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        /* Form Labels */
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-label::after {
            content: " *";
            color: var(--danger-color);
            font-weight: bold;
        }

        /* Remove asterisk for optional fields */
        label[for="price"]::after,
        label[for="amenities"]::after,
        label[for="description"]::after {
            content: "";
        }

        /* Form Controls */
        .form-control,
        .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--gray-800);
            background-color: var(--white);
            background-image: none;
            border: 2px solid var(--gray-300);
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .form-control:focus,
        .form-select:focus {
            color: var(--gray-800);
            background-color: var(--white);
            border-color: var(--primary-color);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
        }

        .form-control::placeholder {
            color: var(--gray-400);
            opacity: 1;
        }

        /* Input Group Styling */
        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--gray-600);
            text-align: center;
            white-space: nowrap;
            background-color: var(--gray-100);
            border: 2px solid var(--gray-300);
            border-right: 0;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
        }

        .input-group .form-control {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            border-left: 0;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }

        .input-group .form-control:focus {
            z-index: 3;
            border-left: 2px solid var(--primary-color);
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            background-color: rgba(37, 99, 235, 0.05);
        }

        /* Textarea */
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Button Styling */
        .btn {
            display: inline-block;
            font-weight: 500;
            line-height: 1.5;
            color: var(--white);
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: transparent;
            border: 2px solid transparent;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }

        /* Primary Button */
        .btn-primary {
            color: var(--white);
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            color: var(--white);
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-primary:focus {
            color: var(--white);
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        /* Outline Secondary Button */
        .btn-outline-secondary {
            color: var(--gray-600);
            border-color: var(--gray-300);
            background-color: var(--white);
        }

        .btn-outline-secondary:hover {
            color: var(--white);
            background-color: var(--gray-600);
            border-color: var(--gray-600);
        }

        .btn-outline-secondary:focus {
            box-shadow: 0 0 0 0.2rem rgba(100, 116, 139, 0.25);
        }

        /* Button Icons */
        .btn i {
            font-size: 0.875rem;
        }

        .me-2 {
            margin-right: 0.5rem;
        }

        /* Button Group */
        .d-flex {
            display: flex;
        }

        .gap-2 {
            gap: 0.5rem;
        }



        /* Loading State */
        .btn:disabled {
            pointer-events: none;
            opacity: 0.65;
        }

        .btn.loading::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid transparent;
            border-top-color: currentColor;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                margin: 0.5rem;
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.25rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .d-flex {
                flex-direction: column;
            }

            .gap-2 {
                gap: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.125rem;
            }

            .form-control,
            .form-select {
                font-size: 16px;
                /* Prevents zoom on iOS */
            }
        }



        /* High Contrast Mode Support */
        @media (prefers-contrast: high) {

            .form-control,
            .form-select {
                border-width: 3px;
            }

            .btn {
                border-width: 3px;
            }
        }

        /* Reduced Motion Support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Print Styles */
        @media print {
            .form-container {
                box-shadow: none;
                border: 1px solid var(--gray-400);
            }

            .btn {
                display: none;
            }
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            position: relative;
        }

        .table-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px 20px 0 0;
        }

        /* Table Header */
        .table-container .bg-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
            border-bottom: 2px solid #dee2e6;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        .table thead th {
            background: linear-gradient(135deg, #343a40 0%, #495057 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px 12px;
            border: none;
            position: relative;
        }

        .table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .table tbody td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .table tbody tr:hover td {
            border-bottom-color: #dee2e6;
        }


        /* Action Buttons */
        .btn-danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #dc3545;
            box-shadow: 0 3px 10px rgba(255, 154, 158, 0.3);
             padding: 8px 12px;
             font-size: 0.85rem;
             font-weight: 600;
                border: none;
                width: 115px;
                padding: 12px;
                margin-top: 10px;
            border-radius: 20px;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.4);
        }

       

        .btn-group-sm .btn {
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            margin: 0 2px;
        }

        .btn-outline-primary {
            border-color: #667eea;
            color: #667eea;
        }

        .btn-outline-primary:hover {
            background-color: #667eea;
            border-color: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-outline-info {
            border-color: #17a2b8;
            color: #17a2b8;
        }

        .btn-outline-info:hover {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(23, 162, 184, 0.3);
        }

        

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
                margin-bottom: 25px;
            }

            .section-title {
                font-size: 1.3rem;
                margin-bottom: 20px;
            }

            .form-control,
            .form-select {
                padding: 10px 14px;
                font-size: 0.9rem;
            }

            .btn-primary,
            .btn-outline-secondary {
                padding: 10px 25px;
                font-size: 0.9rem;
            }

            .table-responsive {
                border-radius: 0;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th {
                padding: 12px 8px;
                font-size: 0.8rem;
            }

            .table tbody td {
                padding: 12px 8px;
            }

            .btn-group-sm .btn {
                padding: 6px 10px;
                font-size: 0.8rem;
                margin: 0 1px;
            }

            .status-available,
            .status-occupied,
            .status-maintenance {
                padding: 6px 12px;
                font-size: 0.75rem;
                min-width: 70px;
            }
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 20px;
            }

            .section-title {
                font-size: 1.2rem;
            }

            .btn-primary,
            .btn-outline-secondary {
                width: 100%;
                margin-bottom: 10px;
            }

            .d-flex.gap-2 {
                flex-direction: column;
            }
        }

        /* Animation Effects */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* Custom Scrollbar for Table */
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #764ba2, #667eea);
        }

        /* Loading States */
        .form-control:disabled,
        .form-select:disabled {
            background-color: #f8f9fa;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Tooltip Styles */
        [title] {
            position: relative;
            cursor: help;
        }

        /* Focus States for Accessibility */
        .form-control:focus,
        .form-select:focus,
        .btn:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Print Styles */
        @media print {
            .form-container {
                box-shadow: none;
                border: 1px solid #000;
                page-break-inside: avoid;
            }

            .table-container {
                box-shadow: none;
                border: 1px solid #000;
            }

            .btn {
                display: none;
            }

            .status-available,
            .status-occupied,
            .status-maintenance {
                background: transparent !important;
                color: #000 !important;
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>

 
    <!-- =======chambre==================== -->

    <!-- Add Chamber Form -->
    <div class="form-container">
        <h3 class="section-title"><i class="fas fa-plus me-2"></i>Add New Chamber</h3>
        <form action="add_chambre.php" method="POST">
            <div class="row">

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="id_hotel" class="form-label">Id hotel *</label>
                        <input type="text" class="form-control" id="id_hotel" name="id_hotel" required placeholder="e.g., Royal Suite">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type_chambre" class="form-label">Type *</label>
                        <select class="form-select" id="type_chambre" name="type_chambre" required>
                            <option value="">Select Type</option>
                            <option value="Standard">Standard</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Suite">Suite</option>
                            <option value="Presidential">Presidential</option>
                            <option value="Executive">Executive</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="floor" class="form-label">Floor *</label>
                        <select class="form-select" id="floor" name="floor" required>
                            <option value="">Select Floor</option>
                            <option value="Ground">Ground Floor</option>
                            <option value="1st">1st Floor</option>
                            <option value="2nd">2nd Floor</option>
                            <option value="3rd">3rd Floor</option>
                            <option value="4th">4th Floor</option>
                            <option value="5th">5th Floor</option>
                            <option value="6th">6th Floor</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="disponibilite" class="form-label">disponibilite *</label>
                        <select class="form-select" id="disponibilite" name="disponibilite" required>
                            <option value="Available" selected>Available</option>
                            <option value="Occupied">Occupied</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="prix" class="form-label">prix per Night</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01" placeholder="0.00">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre_lits" class="form-label">Nombre de Lits *</label>
                        <input type="number" class="form-control" id="nombre_lits" name="nombre_lits" required min="1" max="10" placeholder="e.g., 2">
                    </div>
                </div>

            </div>
            <div class="mb-3">
                <label for="discription" class="form-label">discription</label>
                <textarea class="form-control" id="discription" name="discription" rows="3" placeholder="Enter chamber discription and special features"></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Add Chamber
                </button>
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="fas fa-undo me-2"></i>Reset Form
                </button>
            </div>
        </form>
    </div>


    <!-- Chambers Table -->
    <div class="table-container">
        <div class="p-3 bg-light border-bottom p-5">
            <h3 class="section-title mb-0 ">Current Chambers</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>Type Chambre</th>
                        <th>prix</th>
                        <th>Floor</th>
                        <th>id hotel</th>
                        <th>disponibilite</th>
                        <th>nobre lits</th>
                        <th>discription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($chambres as $chambre): ?>
                        <tr>
                            <td><?= $chambre['id_chambre'] ?></td>
                            <td><?= $chambre['type_chambre'] ?></td>
                            <td><?= $chambre['prix'] ?></td>
                            <td><?= $chambre['floor'] ?></td>
                            <td><?= $chambre['id_hotel'] ?></td>
                            <td><?= $chambre['disponibilite'] ?></td>
                            <td><?= $chambre['nombre_lits'] ?></td>
                            <td><?= $chambre['discription'] ?></td>

                            <td>
                                <a href="edit_chambre.php?id=<?= $chambre['id_chambre'] ?>" class="btn btn-primary  btn-sm"> Modifier</a>
                                <a href="delete_chambre.php?id=<?= $chambre['id_chambre'] ?>" class="btn btn-danger mt-5 btn-sm">Supprimer</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>


    <!-- =========== Scripts =========  -->
    <script src="./javascript/admin.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>