  // script.js
  document.addEventListener("DOMContentLoaded", () => {
    const profile = {
      name: "Akoèno Arnaud",
      bio: "Étudiant en informatique à l'IAEC",
      email: "arnaudafedikou70@gmail.com",
      phone: "96 15 92 57",
      address: "Lomé, Togo",
      photo: "avatar-placeholder.png"
    };
  
    // Charger les données du profil
    function loadProfile() {
      document.getElementById("name").textContent = profile.name;
      document.getElementById("bio").textContent = profile.bio;
      document.getElementById("email").textContent = profile.email;
      document.getElementById("phone").textContent = profile.phone;
      document.getElementById("address").textContent = profile.address;
      document.getElementById("profile-pic").src = profile.photo;
    }
  
    // Activer le bouton Modifier
    document.getElementById("edit-btn").addEventListener("click", () => {
      const newName = prompt("Entrez un nouveau nom :", profile.name);
      const newBio = prompt("Entrez une nouvelle biographie :", profile.bio);
      if (newName) profile.name = newName;
      if (newBio) profile.bio = newBio;
      loadProfile();
    });
  
    loadProfile(); // Charger le profil au début
  });
  
  document.getElementById("profile-pic").addEventListener("click", () => {
  const fileInput = document.getElementById("upload-photo");
  fileInput.click();
  fileInput.onchange = (e) => {
    const reader = new FileReader();
    reader.onload = (event) => {
      profile.photo = event.target.result;
      loadProfile();
    };
    reader.readAsDataURL(e.target.files[0]);
  };
});