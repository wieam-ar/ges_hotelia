<?php
include './includes/db.php';

$stmt = $pdo->query("SELECT * FROM clients");
$clients = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard </title>

    <style>
       
        .table-responsive {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .table-bordered {
            border: 2px solid #e2e8f0;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: rgba(102, 126, 234, 0.03);
        }

        .table-dark {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            color: white;
        }

        .table th,
        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e2e8f0;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 14px;
            background: linear-gradient(135deg, rgb(22, 21, 21) 0%, rgb(0, 0, 0) 100%);
            color: white;
            border: none;
        }

        .table td {
            font-size: 15px;
            background: rgba(255, 255, 255, 0.8);
        }

        .text-center {
            text-align: center;
        }

        .align-middle {
            vertical-align: middle;
        }

        /* ====== Image Styles ====== */
        .img-thumbnail {
            border: 3px solid #e2e8f0;
            border-radius: 8px;
            padding: 4px;
            background: white;
            transition: all 0.3s ease;
            max-width: 80px;
            height: auto;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-color: #667eea;
        }

        /* btn */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            justify-content: space-between;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            margin-top: 10px;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: #dc3545;
            box-shadow: 0 3px 10px rgba(255, 154, 158, 0.3);
            margin-top: 10px;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.4);
            color: #a71e2a;
            margin-top: 10px;
        }

        /* ====== Responsive Design ====== */
        @media (max-width: 768px) {
            .form-container {
                margin: 10px;
                padding: 20px;
            }

            .table-responsive {
                margin: 10px;
                padding: 15px;
            }

            .form-control {
                padding: 12px 15px;
                font-size: 14px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            .btn-sm {
                padding: 6px 12px;
                font-size: 12px;
            }

            h3 {
                font-size: 24px;
            }

            .table th,
            .table td {
                padding: 10px 8px;
                font-size: 13px;
            }

            .img-thumbnail {
                max-width: 60px;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                margin: 5px;
                padding: 15px;
            }

            .table-responsive {
                margin: 5px;
                padding: 10px;
            }

            .table {
                font-size: 12px;
            }

            .table th,
            .table td {
                padding: 8px 6px;
            }

            .btn-sm {
                padding: 4px 8px;
                font-size: 11px;
            }

            .img-thumbnail {
                max-width: 50px;
            }

            h3 {
                font-size: 20px;
            }
        }

        /* ====== Animation Effects ====== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container,
        .table-responsive {
            animation: fadeInUp 0.6s ease-out;
        }

        /* ====== Hover Effects ====== */
        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>email</th>
                    <th>telephone</th>
                    <th>adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client['id_client'] ?></td>
                        <td><?= $client['nom'] ?></td>
                        <td><?= $client['email'] ?></td>
                        <td><?= $client['telephone'] ?></td>
                        <td><?= $client['adresse'] ?></td>

                        <td>
                            <a href="edit_client.php?id=<?= $client['id_client'] ?>" class="btn btn-primary  btn-sm"> Modifier</a>
                            <a href="delete_client.php?id=<?= $client['id_client'] ?>" class="btn btn-danger mt-5 btn-sm">Supprimer</a>

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