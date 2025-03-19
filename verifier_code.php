<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio_iaec";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$identifiant = $_POST['Numadmin'];
$code_acces = $_POST['code'];

$sql = "SELECT * FROM access_code WHERE Numadmin = ? AND code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $identifiant, $code_acces);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Validé";
} else {
    echo "Identifiant ou code d'accès invalide.";
}

$stmt->close();
$conn->close(); 
?>