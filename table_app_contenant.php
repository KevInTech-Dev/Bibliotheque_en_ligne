<?php
session_start();
$id_session = session_id();
$servername = "localhost";
$username = "root";
$password = "";
$bdname = "biblio_iaec";

// Connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $bdname);
if (!$conn) {
    die("Connexion failed: " . mysqli_connect_error());
}

if (isset($_POST["valider"]) && isset($_FILES["image"])) {

    // Récupération des données du fichier
    $nom = basename($_FILES["image"]["name"]); // Sécurisation du nom du fichier
    $taille = $_FILES["image"]["size"];
    $type = $_FILES["image"]["type"];
    $bin = file_get_contents($_FILES["image"]["tmp_name"]);
    $uploadDate = date("Y-m-d H:i:s");
    $id_user = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : NULL; // Récupération de l'ID utilisateur

    // Récupération et validation de l'accessibilité
    if (isset($_POST["accessibility"])) {
        $accessibility = trim($_POST["accessibility"]);
        if ($accessibility !== "public" && $accessibility !== "private") {
            $accessibility = "private"; // Sécurité : valeur par défaut si incorrecte
        }
    } else {
        $accessibility = "private"; // Valeur par défaut si non définie
    }

    // Définition du chemin de stockage
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Création du dossier s'il n'existe pas
    }
    $filePath = $uploadDir . $nom;

    // Vérification du type MIME autorisé
    $allowedTypes = [
        "image/jpeg", "image/png", "image/gif",   // Images
        "application/pdf", "application/msword",  // PDF, DOC
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document", // DOCX
        "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", // XLS, XLSX
        "text/plain"  // Fichiers texte
    ];
    
    if (!in_array($type, $allowedTypes)) {
        die("Erreur : Type de fichier non autorisé.");
    }

    // Vérification de la taille du fichier (max 5 Mo)
    if ($taille > 5 * 1024 * 1024) {
        die("Erreur : Fichier trop volumineux (max 5 Mo).");
    }

    // Déplacement du fichier vers le répertoire de stockage
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $filePath)) {
        die("Erreur : Échec de l'upload.");
    }

    // Préparation et exécution de la requête
    $req = $conn->prepare("INSERT INTO app_contents (id_content, content_name, content_path, content_size, content_typeMIME, content_upload_date, content_bin, content_accessibility, id_user) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Liaison des paramètres
    $req->bind_param("ssissssi", $nom, $filePath, $taille, $type, $uploadDate, $bin, $accessibility, $id_user);

    // Exécution de la requête
    if ($req->execute()) {
        echo '<p class="message success-message">✅ Upload réussi !</p>';
    } else {
        echo '<p class="message error-message">❌ Erreur lors de l\'upload : ' . $req->error . '</p>';
    }

    // Fermeture de la connexion
    $req->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload d'une image</title>
    <link href="http://cdn.jsdelivr.net/npm/bootstrap@s.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="table_app.css">
</head>
<body>
    <form name="fo" method="post" action="" enctype="multipart/form-data">
        <input type="file" name="image" required /><br /><br />

        <label for="accessibility">Accessibilité :</label>
        <select name="accessibility" required>
            <option value="public">Public</option>
            <option value="private">Privé</option>
        </select><br /><br />

        <input type="submit" name="valider" value="Charger" />
    </form>  
</body>
</html>
