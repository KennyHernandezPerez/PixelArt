<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fondo-login">
    <div class="container">
        <div class="registro">
            <?php
            $servername = "b5rhowkextbchzcrjhhc-mysql.services.clever-cloud.com";
            $username = "upesbtzii1wqcgnm";
            $password = "n5actU9NkvH5wgN3REyJ";
            $dbname = "b5rhowkextbchzcrjhhc";


            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("La conexión falló: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];
                $correo = $_POST['correo']; // Nuevo campo para el correo electrónico

                $sql = "INSERT INTO usuarios (usuario, pass, correo) VALUES ('$usuario', '$contrasena', '$correo')";

                if ($conn->query($sql) === TRUE) {
                    echo "Usuario registrado exitosamente.";
                    header("refresh:3; url=index.html");
                } else {
                    echo "Error al registrar el usuario: " . $conn->error;
                }
            }
            ?>
            <h2>Registro de Usuario</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="email" name="correo" placeholder="Correo electrónico" required> <!-- Nuevo campo para el correo electrónico -->
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
            <a href="index.html">Inicio</a>
        </div>
    </div>
</body>
</html>
