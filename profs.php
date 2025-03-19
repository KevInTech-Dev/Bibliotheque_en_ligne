<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Documents</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>GESTION DES DOCUMENTS</h1>
  </header>
  <main>
    <section id="login-section">
      <h2>Accès Restreint</h2>
      <p>Veuillez obtenir l'autorisation de l'administrateur pour accéder aux fichiers.</p>
      <button id="request-access-btn">Demander l'accès</button>
    </section>

    <section id="document-section" class="hidden">
      <h2>Documents</h2>
      <ul id="file-list"></ul>
      <div id="file-actions" class="hidden">
        <button id="add-file-btn"><a href="table_app_contenant.php">Ajouter un fichier</a></button>
      </div>
    </section>
  </main>

  <script src="scripts.js"></script>
</body>
</html>
