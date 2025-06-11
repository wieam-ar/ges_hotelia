<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messages - Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .messages-container {
      max-width: 1000px;
      margin: 50px auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      padding: 25px;
    }

    .message-item {
      padding: 15px 10px;
      border-bottom: 1px solid #eee;
      transition: 0.2s;
    }

    .message-item:hover {
      background-color: #f1f1f1;
    }

    .message-title {
      font-weight: 600;
      color: #333;
    }

    .message-meta {
      font-size: 14px;
      color: #666;
    }

    .message-body {
      color: #555;
      margin-top: 5px;
    }

    .btn-reply {
      font-size: 14px;
      padding: 4px 10px;
    }
  </style>
</head>
<body>

<div class="container messages-container">
  <h3 class="mb-4"><i class="fas fa-envelope-open-text me-2"></i> Boîte de réception</h3>

  <!-- Example Message -->
  <div class="message-item">
    <div class="d-flex justify-content-between">
      <span class="message-title">Demande de réservation</span>
      <span class="message-meta">05/06/2025 - 11:30</span>
    </div>
    <div class="message-meta">De : <strong>mohamed@example.com</strong></div>
    <div class="message-body">Bonjour, je voudrais réserver une chambre du 10 au 15 juin. Merci !</div>
    <a href="mailto:mohamed@example.com" class="btn btn-sm btn-outline-primary btn-reply mt-2">Répondre</a>
  </div>

  <!-- Repeat this block for each message -->
  <div class="message-item">
    <div class="d-flex justify-content-between">
      <span class="message-title">Problème de paiement</span>
      <span class="message-meta">04/06/2025 - 16:45</span>
    </div>
    <div class="message-meta">De : <strong>sara@site.com</strong></div>
    <div class="message-body">J'ai essayé de payer mais cela ne fonctionne pas. Pouvez-vous m'aider ?</div>
    <a href="mailto:sara@site.com" class="btn btn-sm btn-outline-primary btn-reply mt-2">Répondre</a>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
