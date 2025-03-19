document.addEventListener("DOMContentLoaded", () => {
  const requestAccessBtn = document.getElementById("request-access-btn");
  const loginSection = document.getElementById("login-section");
  const documentSection = document.getElementById("document-section");
  const fileList = document.getElementById("file-list");
  const fileActions = document.getElementById("file-actions");
  const addFileBtn = document.getElementById("add-file-btn");

  // Liste initiale de fichiers
  let files = ["Document1.txt", "Document2.pdf", "Document3.docx"];
  let isAdminAuthorized = false;

  // Fonction pour afficher la liste des fichiers
  function displayFiles() {
      fileList.innerHTML = files.map(file => `<li>${file}</li>`).join("");
  }

  // Gestion de l'accès utilisateur
  requestAccessBtn.addEventListener("click", () => {
      const accessGranted = confirm("L'administrateur vous autorise-t-il à accéder ?");
      if (accessGranted) {
          isAdminAuthorized = true;
          loginSection.classList.add("hidden");
          documentSection.classList.remove("hidden");
          fileActions.classList.remove("hidden");
          displayFiles();
      } else {
          alert("Accès refusé par l'administrateur.");
      }
  });

  // Redirection vers une autre page lorsqu'on clique sur "Ajouter un fichier"
  addFileBtn.addEventListener("click", () => {
      window.location.href = "table_app_contenant.php"; // Redirection vers la page d'upload
  });
});
