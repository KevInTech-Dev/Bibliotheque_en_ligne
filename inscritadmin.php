<?php 
session_start(); 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "biblio_iaec"; 
$conn = mysqli_connect($servername, $username, $password, $dbname); 

if (!$conn) { 
    die("Connexion échouée : " . mysqli_connect_error()); 
} 

$conn->set_charset("utf8mb4");   

$message = ""; // Initialiser le message

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $code = mysqli_real_escape_string($conn, $_POST['code']); 
    $Numadmin = mysqli_real_escape_string($conn, $_POST['Numadmin']); 

    // Vérification de l'identifiant et du code d'accès
    $checkAdminQuery = "SELECT * FROM access_code WHERE Numadmin = '$Numadmin' AND code = '$code'"; 
    $checkAdminResult = mysqli_query($conn, $checkAdminQuery); 

    if (mysqli_num_rows($checkAdminResult) > 0) { 
        // L'identifiant et le code d'accès sont valides
        $row = mysqli_fetch_assoc($checkAdminResult);
        

        // Rediriger vers une page de gestion ou d'accueil
        $_SESSION['Numadmin'] = $Numadmin; // Vous pouvez stocker d'autres informations si nécessaire
        $message = "Accès accordé. Bienvenue, $nom !";
        header("Location: table_app_contenant.php?id_user=$Numadmin"); 
        exit; // Terminer le script après la redirection
    } else { 
        $message = "Identifiant ou code d'accès invalide."; 
    } 
} 
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
            font-weight: bold;
        }
        .form-container {
            max-width: 600px;
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
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
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
    <h1>Inscription</h1>
    <div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="Numadmin">Identifiant</label>
                <input type="text" id="Numadmin" name="Numadmin" required>
            </div>
            <div class="form-group">
                <label for="code">Code d'accès</label>
                <input type="text" id="code" name="code" required>
            </div>
            <button type="submit">Envoyer</button>
            <p style="text-align: center;">Vous n'êtes pas administrateur ? <a href="index.php">Retour</a></p>
        </form>
        <?php
            if (isset($message)) {
                echo "<p style='color: red;'>$message</p>";
            }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>