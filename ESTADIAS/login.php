<?php
session_start();

// Datos de conexión
$host = "utpplib.ddns.net";
$dbname = "biblioteca";
$usernameDB = "Luison";
$passwordDB = "particularmenteLuis12+1";

// Conexión a MySQL
$conn = new mysqli($host, $usernameDB, $passwordDB, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST); // Depura lo que se recibe
    exit();

    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $conn->real_escape_string($_POST['contrasena']);

    $sql = "SELECT * FROM usuariosAdmin WHERE usuario='$usuario' AND contrasena='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos o usuario inactivo'); window.location.href = 'login.html';</script>";
        exit();
    }
}

$conn->close();

?>
