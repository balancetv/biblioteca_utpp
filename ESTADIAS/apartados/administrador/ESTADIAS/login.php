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

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $conn->real_escape_string($_POST['contraseña']);

    // Consulta usando la nueva tabla 'usuarios'
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$password'  /*AND estatus='Activo' */";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nivel'] = $row['nivel'];
        $_SESSION['nombre'] = $row['nombre'];
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos o usuario inactivo'); window.location.href = 'login.html';</script>";
        exit();
    }
}

$conn->close();
?>
