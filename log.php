<?php
// Conexión a la base de datos
$servername = "b5rhowkextbchzcrjhhc-mysql.services.clever-cloud.com";
$username = "upesbtzii1wqcgnm";
$password = "n5actU9NkvH5wgN3REyJ";
$dbname = "b5rhowkextbchzcrjhhc";

$conn = new mysqli($servername, $username, $password, $dbname);

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
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("Location: inicio.php"); // Redirigir a la página de inicio
} else {
    // Inicio de sesión fallido
    echo "Usuario o contraseña incorrectos.";
    echo '<a href="registro.php">Registrate</a>';
}

$conn->close();
?>
