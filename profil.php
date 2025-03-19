<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    header("Location: connect_visit.php");
    exit;
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio_iaec";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");

// Récupération des informations de l'utilisateur
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM users_infos WHERE id_user = '$id_user'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moteur de recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .profile-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .profile-info {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ff5757;
            color: white;
            text-align: center;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #ff5757;
        }
    </style>
</head>
<body>
    <h1>Profil : <?php echo htmlspecialchars($user['user_lastname']); ?></h1>
    <div class="profile-container">
        <div class="profile-group">
            <label for="user_lastname">Nom :</label>
            <div class="profile-info"><?php echo htmlspecialchars($user['user_lastname']); ?></div>
        </div>
        <div class="profile-group">
            <label for="user_firstname">Prénom :</label>
            <div class="profile-info"><?php echo htmlspecialchars($user['user_firstname']); ?></div>
        </div>
        <div class="profile-group">
            <label for="user_email">Email :</label>
            <div class="profile-info"><?php echo htmlspecialchars($user['user_email']); ?></div>
        </div>
        <div class="profile-group">
            <label for="user_sexe">Genre :</label>
            <div class="profile-info"><?php echo htmlspecialchars($user['user_sexe']); ?></div>
        </div>
        <a href="index.php" class="btn">Se déconnecter</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>