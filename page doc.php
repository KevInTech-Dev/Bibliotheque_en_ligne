<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <!-- En-tête de la page -->
    <h1>GESTION DES DOCUMENTS</h1>
    <div id="file-actions" class="hidden">
        <input type="text" id="new-file-name" placeholder="Nom du fichier">
        <button id="add-file-btn">Ajouter</button>
        <button id="edit-file-btn">Modifier</button>
      </div>
  </header>
  <main>
    <!-- Section des documents, masquée par défaut -->
    <section id="document-section" class="hidden">
      <h2>Documents</h2>
      <!-- Liste des fichiers disponibles -->
      <ul id="file-list"></ul>
      <!-- Zone d'actions pour ajouter/modifier des fichiers -->
    </section>

    <!-- Section des documents, masquée par défaut -->
    <section id="document-section" class="hidden">
      <h2>Documents</h2>
      <!-- Liste des fichiers disponibles -->
      <ul id="file-list"></ul>
      <!-- Zone d'actions pour ajouter/modifier des fichiers -->
    </section>
  </main>
  <!-- Lien vers le fichier JavaScript pour gérer les interactions -->
  <script src="scripts.js">
    // Exécuter le script une foi666666666666666666666666666666666666666s la page chargée
document.addEventListener("DOMContentLoaded", () => {
    // Sélection des éléments du DOM
    const requestAccessBtn = document.getElementById("request-access-btn");
    const loginSection = document.getElementById("login-section");
    const documentSection = document.getElementById("document-section");
    const fileList = document.getElementById("file-list");
    const fileActions = document.getElementById("file-actions");
    const addFileBtn = document.getElementById("add-file-btn");
    const editFileBtn = document.getElementById("edit-file-btn");
    const newFileNameInput = document.getElementById("new-file-name");
  
    // Liste initiale de fichiers
    let files = ["Document1.txt", "Document2.pdf", "Document3.docx"];
    // Indicateur pour savoir si l'utilisateur est autorisé
    let isAdminAuthorized = false;
  
    // Fonction pour afficher la liste des fichiers
    function displayFiles() {
      // Génère une liste HTML à partir du tableau "files"
      fileList.innerHTML = files.map(file => `<li>${file}</li>`).join("");
    }
  
    // Gestion de l'accès utilisateur
    requestAccessBtn.addEventListener("click", () => {
      // Simule une autorisation via un "confirm"
      const accessGranted = confirm("L'administrateur vous autorise-t-il à accéder ?");
      if (accessGranted) {
        // Si autorisé, afficher les documents et les actions
        isAdminAuthorized = true;
        location.href = "page doc.php";
        loginSection.classList.add("hidden"); // Masque la section d'accès
        documentSection.classList.remove("hidden"); // Affiche les documents
        fileActions.classList.remove("hidden"); // Affiche les actions
        displayFiles(); // Met à jour la liste des fichiers
      } else {
        alert("Accès refusé par l'administrateur."); // Message d'erreur
      }
    });
  
    // Ajouter un nouveau fichier
    addFileBtn.addEventListener("click", () => {
      const newFileName = newFileNameInput.value.trim(); // Récupère et nettoie le nom entré
      if (newFileName) {
        files.push(newFileName); // Ajoute le fichier à la liste
        displayFiles(); // Met à jour l'affichage
        newFileNameInput.value = ""; // Réinitialise le champ
      } else {
        alert("Veuillez entrer un nom de fichier valide."); // Alerte si le champ est vide
      }
    });
  
    // Modifier un fichier existant
    editFileBtn.addEventListener("click", () => {
      // Demande à l'utilisateur le fichier à modifier et le nouveau nom
      const fileToEdit = prompt("Entrez le nom du fichier à modifier:");
      const newFileName = prompt("Entrez le nouveau nom:");
      const fileIndex = files.indexOf(fileToEdit); // Trouve l'index du fichier
  
      if (fileIndex !== -1 && newFileName) {
        files[fileIndex] = newFileName; // Met à jour le nom du fichier
        displayFiles(); // Met à jour l'affichage
      } else {
        alert("Fichier introuvable ou nom invalide."); // Alerte en cas d'erreur
      }
    });
  });
  </script>
</body>
</html>