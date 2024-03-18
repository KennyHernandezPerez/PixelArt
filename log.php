<?php
// Iniciar sesión
session_start();

// Variables para la conexión a la base de datos
$servername = $_ENV["DB_HOST"];
$username = $_ENV["DB_USER"];
$password = $_ENV["DB_PASSWORD"];
$dbname = $_ENV["DB_NAME"];
$port = $_ENV["DB_PORT"];

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consulta para verificar las credenciales de inicio de sesión
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$contrasena'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    $_SESSION['usuario'] = $usuario;
    header("Location: inicio.php"); // Redirigir a la página de inicio
    exit(); // Importante para detener la ejecución después de redirigir
} else {
    // Inicio de sesión fallido
    echo "Usuario o contraseña incorrectos.";
}

$conn->close();
?>
