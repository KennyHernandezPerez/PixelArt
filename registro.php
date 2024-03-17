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
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "log_pag";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("La conexión falló: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];

                $sql = "INSERT INTO usuarios (usuario, pass) VALUES ('$usuario', '$contrasena')";

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
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>

