<?php
include './includes/db.php';

// Delete logic
if (isset($_GET['delete_id'])) {
  $id = (int) $_GET['delete_id'];
  $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
  $stmt->execute([$id]);
  header("Location: messages.php");
  exit();
}

// Fetch all feedback
$stmt = $pdo->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
$feedbacks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Gestion des Feedbacks</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    /* Reset some default styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 20px;
      background-color: #fafafa;
      color: #333;
    }

    /* Heading */
    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #222;
    }

    /* Table styles */
    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto 40px auto;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    thead tr {
      background: rgb(0, 0, 0);
      color: #fff;
      font-weight: 600;
    }

    th,
    td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      vertical-align: top;
    }

    tbody tr:hover {
      background-color: #f1f8ff;
    }

    /* Make multi-line fields look neat */
    td pre {
      white-space: pre-wrap;
      margin: 0;
      font-family: inherit;
      font-size: 0.95em;
      color: #555;
    }

    /* Delete button styling */
    a.btn-danger {
      color: #dc3545;
      font-weight: bold;
      text-decoration: none;
      padding: 6px 12px;
      border: 1px solid #dc3545;
      border-radius: 4px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    a.btn-danger:hover {
      background-color: #dc3545;
      color: #fff;
    }

    /* Responsive design for smaller screens */
    @media (max-width: 900px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      thead tr {
        display: none;
      }

      tbody tr {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
      }

      tbody tr td {
        padding: 10px 10px;
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: right;
      }

      tbody tr td::before {
        position: absolute;
        top: 10px;
        left: 15px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        font-weight: 600;
        text-align: left;
        color: rgb(2, 2, 2);
        content: attr(data-label);
      }
    }
  </style>
</head>

<body>
  <h1><a href="admin.php"><i class="fa-arrow-left "></i></a>Gestion des Feedbacks</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Satisfaction</th>
        <th>Aspects appréciés</th>
        <th>Commentaires</th>
        <th>Améliorations</th>
        <th>Date de soumission</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($feedbacks) === 0): ?>
        <tr>
          <td colspan="10">Aucun feedback trouvé.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($feedbacks as $fb): ?>
          <tr>
            <td><?= htmlspecialchars($fb['id']) ?></td>
            <td><?= htmlspecialchars($fb['name']) ?></td>
            <td><?= htmlspecialchars($fb['email']) ?></td>
            <td><?= htmlspecialchars($fb['phone']) ?></td>
            <td><?= htmlspecialchars($fb['satisfaction']) ?></td>
            <td>
              <pre><?= htmlspecialchars($fb['liked_aspects']) ?></pre>
            </td>
            <td>
              <pre><?= htmlspecialchars($fb['comments']) ?></pre>
            </td>
            <td>
              <pre><?= htmlspecialchars($fb['improvements']) ?></pre>
            </td>
            <td><?= htmlspecialchars($fb['submitted_at']) ?></td>
            <td>
              <a href="messages.php?delete_id=<?= $fb['id'] ?>"
                class="btn btn-danger btn-sm d-flex"
                onclick="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                 Supprimer
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

</body>

</html>