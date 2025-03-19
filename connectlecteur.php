<?php
// Démarrage de la session
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio_iaec";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

// Traitement du formulaire de connexion
$conn->set_charset("utf8mb4"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = mysqli_real_escape_string($conn, $_POST['user_email']);
    $mdp = mysqli_real_escape_string($conn, $_POST['user_password']);
    
    // Vérification des identifiants dans la base de données
    $sql = "SELECT * FROM users_infos WHERE user_email = '$mail' AND user_password = '$mdp'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Identifiants valides, connexion réussie
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $row['id_user']; // Assurez-vous que 'id_user' correspond à votre colonne ID
        $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
        header("Location: profil.php?id_user=" . $_SESSION['id_user']); 
        exit;
    } else {
        // Identifiants invalides, affichage d'un message d'erreur
        $error_message = "Adresse email ou mot de passe incorrect.";
    }
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
            font-weight: bold
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #ff5757;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff5757;
        }
        .error {
            color: red;
            text-align: center;
        }
        .navbar,.form-container,h1{font-family: "Trirong", serif;}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light text-light bg-light sticky-top">
        <a href="#"><img src="image/w-a.png" style="height: 100px; width:auto; margin-left: 30px;"></a>
        <button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-between" id="nav">
            <ul class="navbar-nav" style="margin-left: 20px;">
                <li class="nav-item" ><a class="nav-link" href="index.php">Accueil</a></li>
                <li class="nav-item" ><a class="nav-link" href="propos.php">À propos</a></li>
                <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Explorer</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#ff5757'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';" href="#inscription">Catégorie de livre</a>
                        <a class="dropdown-item" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#ff5757'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';" href="#inscription">Chercher un livre</a>
                        <a class="dropdown-item" style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#ff5757'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';" href="#inscription">Lire un livre</a>
                    </div>
                </li>
                <li class="nav-item" ><a class="nav-link" href="#inscription">Commencer</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
            <form class="form-inline">
                <div class="input-group" >
                    <input type="text" class="form-control" placeholder="Rechercher un livre" aria-label="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn bg-opacity-25 btn-outline-dark"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <h1>Connexion</h1>
    <div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" id="user_email" name="user_email" required>
            </div>
            <div class="form-group">
                <label for="user_password">Mot de passe</label>
                <input type="password" id="user_password" name="user_password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <?php
            if (isset($error_message)) {
                echo "<p class='error'>$error_message</p>";
            }
        ?>
        <p>N'avez-vous pas de compte ? <a href="inscritlecteur.php">Inscription</a></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>