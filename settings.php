<?php
include './includes/db.php';

// Ajouter un hôtel
if (isset($_POST['ajouter'])) {
    $stmt = $pdo->prepare("INSERT INTO hotels (nom_hotel, adresse, description, email, telephone, site_web, ville, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $filename = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($temp, "uploads/" . $filename);

    $stmt->execute([
        $_POST['nom_hotel'], $_POST['adresse'], $_POST['description'], $_POST['email'],
        $_POST['telephone'], $_POST['site_web'], $_POST['ville'], $filename
    ]);
}

// Supprimer un hôtel
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM hotels WHERE id_hotel = ?")->execute([$_GET['delete']]);
      header("Location: settings.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
/* ====== Global Styles ====== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #ff780a 0%, #f1c945 100%);
    min-height: 100vh;
    color: #333;
    line-height: 1.6;
}

/* ====== Main Content Container ====== */
.form-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    margin: 20px;
    padding: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* ====== Form Styles ====== */
form {
    display: grid;
    gap: 20px;
    max-width: 800px;
    margin: 0 auto;
}

.mb-2 {
    position: relative;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e1e5e9;
    border-radius: 12px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(5px);
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.form-control::placeholder {
    color: #999;
    font-style: italic;
}

/* ====== File Input Styling ====== */
input[type="file"] {
    padding: 12px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8ecff 100%);
    border: 2px dashedrgb(255, 255, 255);
    cursor: pointer;
}

input[type="file"]:hover {
    background: linear-gradient(135deg, #e8ecff 0%, #d0d8ff 100%);
    border-color: linear-gradient(135deg, #ff780a 0%, #f1c945 100%);
}

/* ====== Textarea Styling ====== */
textarea.form-control {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

/* ====== Button Styles ====== */
.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    justify-content: center;
}

.btn-primary {
    background: linear-gradient(135deg, #ff780a 0%, #f1c945 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-sm {
    padding: 8px 16px;
    font-size: 14px;
}

.btn-warning {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color:rgb(255, 255, 255);
    box-shadow: 0 3px 10px rgba(252, 182, 159, 0.3);
}

.btn-warning:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(252, 182, 159, 0.4);
    color:rgb(255, 255, 255);
}

.btn-danger {
    background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
    color: #dc3545;
    box-shadow: 0 3px 10px rgba(255, 154, 158, 0.3);
}

.btn-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(255, 154, 158, 0.4);
    color: #a71e2a;
}

/* ====== Separator ====== */
.my-5 {
    margin: 40px 0;
    border: none;
    height: 2px;
    background: linear-gradient(90deg, transparent,rgb(255, 187, 39), transparent);
}

/* ====== Headings ====== */
h3 {
    color: #2d3748;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.mb-3 {
    margin-bottom: 25px;
}

/* ====== Table Styles ====== */
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
    background: linear-gradient(135deg,rgb(0, 0, 0) 0%,rgb(0, 0, 0) 100%);
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
    background: rgba(102, 126, 234, 0.08);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* ====== Focus States for Accessibility ====== */
.btn:focus,
.form-control:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* ====== Loading States ====== */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* ====== Custom Scrollbar ====== */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}
    </style>
</head>

<body>
  <?php include 'includes/sidebar.php'; ?>

  <!-- Contenu principal -->
  <div class="form-container" style="padding: 20px;">
    <form method="post">
      <div class=" mb-2"> <input type="text" name="nom" class="form-control" placeholder="Nom de l'hôtel" required> </div>
      <div class=" mb-2"> <input type="email" name="email" class="form-control" placeholder="Email" required> </div>
      <div class=" mb-2"> <input type="url" name="site_web" class="form-control" placeholder="Site Web"> </div>
      <div class=" mb-2"> <input type="text" name="ville" class="form-control" placeholder="Ville / Région" required> </div>
      <div class=" mb-2"> <input type="text" name="telephone" class="form-control" placeholder="Téléphone" required> </div>
      <div class=" mb-2"> <input type="file" name="image" class="form-control" required> </div>
      <div class="mb-2"> <textarea name="description" class="form-control" placeholder="Description" rows="4"></textarea> </div> <button type="submit" name="ajouter" class="btn btn-primary">Ajouter l'hôtel</button>
    </form>
  </div> <!-- Séparateur -->
  <hr class="my-5"> <!-- Liste des hôtels -->
  <h3 class="mb-3">🏨 Liste des Hôtels</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>Nom</th>
          <th>Ville</th>
          <th>Email</th>
          <th>Image</th>
          <th>Actions</th>
        </tr>
      </thead>
      
      <tbody>
       
        <?php
        $hotels = $pdo->query("SELECT * FROM hotels")->fetchAll();
        foreach ($hotels as $hotel) {
          echo "<tr>
                  <td>{$hotel['nom_hotel']}</td>
                  <td>{$hotel['ville']}</td>
                  <td>{$hotel['email']}</td>
                  <td><img src='uploads/{$hotel['image']}' width='80'></td>
                  <td>
                    <a href='modify.php?id={$hotel['id_hotel']}' class='btn btn-sm btn-warning'>Modifier</a>
                    <a href='?delete={$hotel['id_hotel']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Supprimer cet hôtel ?\")'>Supprimer</a>
                  </td>
                </tr>";
        }
        ?>
      
      
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