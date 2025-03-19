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
    die("Connexion échouée : " . mysqli_connect_error());
}

if(isset($_POST["valider"]) && isset($_FILES["image"])){
    // Récupération des données du fichier
    $nom = basename($_FILES["image"]["name"]); // Sécurisation du nom du fichier
    $taille = $_FILES["image"]["size"];
    $type = $_FILES["image"]["type"];
    $uploadDate = date("Y-m-d H:i:s");
    $id_user = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : NULL; // Récupération de l'ID utilisateur

    // Définition de l'accessibilité (Privé/Public)
    $accessibility = isset($_POST["accessibility"]) && $_POST["accessibility"] === "public" ? "public" : "private";

    // Définition du chemin de stockage
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Création du dossier s'il n'existe pas
    }
    $filePath = $uploadDir . $nom;

    // Vérification du type MIME autorisé (ajuster selon les besoins)
    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    if (!in_array($type, $allowedTypes)) {
        die("Erreur : Type de fichier non autorisé.");
    }

    // Vérification de la taille (max 5 Mo)
    if ($taille > 5 * 1024 * 1024) {
        die("Erreur : Fichier trop volumineux (max 5 Mo).");
    }

    // Déplacer le fichier vers le répertoire de stockage
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $filePath)) {
        die("Erreur : Échec de l'upload.");
    }

    // Préparation et exécution de la requête
    $req = $conn->prepare("INSERT INTO app_contents (content_name, content_path, content_size, content_typeMIME, content_upload_date, content_accessibility, id_user) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Associer les types corrects pour `bind_param()`
    $req->bind_param("ssisssi", $nom, $filePath, $taille, $type, $uploadDate, $accessibility, $id_user);

    if ($req->execute()) {
        echo "Upload réussi !";
    } else {
        echo "Erreur lors de l'upload : " . $req->error;
    }

    $req->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Upload d'une image</title>
</head>
<body>
    <form name="fo" method="post" action="" enctype="multipart/form-data">
        <label for="image">Choisissez une image :</label>
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
