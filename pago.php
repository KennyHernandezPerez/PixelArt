<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$servername = "b5rhowkextbchzcrjhhc-mysql.services.clever-cloud.com";
$username = "upesbtzii1wqcgnm";
$password = "n5actU9NkvH5wgN3REyJ";
$database = "b5rhowkextbchzcrjhhc";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$precio_unitario = array();
$sql = "SELECT nombre, precio FROM productos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $precio_unitario[$row["nombre"]] = $row["precio"];
    }
}

$conn->close();

// Verificar si se ha enviado la solicitud para limpiar el carrito
if(isset($_POST['limpiar'])) {
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        header, footer {
            flex: 0 0 auto;
        }

        main {
            flex: 1 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
        }

        .carrito-container, .formulario-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            width: 40%;
            box-sizing: border-box;
        }
    </style>
</head>
<body class="fondo-inicio">
    <header>
        <div class="logo">
            <img src="img/bill.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
        <div class="usuario">
            <?php
            if(isset($_SESSION['usuario'])) {
                echo '<p>' . $_SESSION['usuario'] . '</p>';
            }
            ?>
        </div>
    </header>
    <main>
        <div class="carrito-container">
            <h1>Carrito</h1>
            <form id="carritoForm" method="POST">
                <ul>
                    <?php
                    if(isset($_POST['productos']) && is_array($_POST['productos'])) {
                        $productos_count = array();
                        $total_pagar = 0;
                        
                        foreach ($_POST['productos'] as $producto) {
                            list($nombre, $precio) = explode(" - ", $producto);
                            $nombre = trim($nombre);
                            $precio = trim(substr($precio, 1)); // Eliminar el signo $
                            
                            if (array_key_exists($nombre, $productos_count)) {
                                $productos_count[$nombre]++;
                            } else {
                                $productos_count[$nombre] = 1;
                            }
                            
                            $total_pagar += $precio_unitario[$nombre];
                        }
                        
                        foreach ($productos_count as $producto => $cantidad) {
                            echo '<li>';
                            echo '<input type="hidden" name="productos[]" value="' . htmlspecialchars($producto) . ' - $' . $precio_unitario[$producto] . '">';
                            echo htmlspecialchars($producto) . ' - $' . $precio_unitario[$producto] . ' - Cantidad: ' . $cantidad;
                            echo '</li>';
                        }
                        
                        echo '<li>Total a pagar: $' . number_format($total_pagar, 2) . '</li>';
                    } else {
                        echo '<li>No se han recibido productos.</li>';
                    }
                    ?>
                </ul>
                <button type="submit" name="limpiar" value="limpiar">Limpiar Carrito</button>
            </form>
        </div>
        <div class="formulario-container">
            <h2>Formulario de Pago</h2>
            <form id="pagoForm" method="POST">
                <label for="nombre">Nombre en la tarjeta:</label><br>
                <input type="text" id="nombre" name="nombre"><br><br>

                <label for="numero_tarjeta">Número de tarjeta:</label><br>
                <input type="text" id="numero_tarjeta" name="numero_tarjeta" pattern="[0-9]{16}" placeholder="Ingrese los 16 dígitos"><br><br>

                <label for="fecha_vencimiento">Fecha de vencimiento:</label><br>
                <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/AA"><br><br>

                <label for="cvv">CVV:</label><br>
                <input type="text" id="cvv" name="cvv" pattern="[0-9]{3}" placeholder="Ingrese los 3 dígitos"><br><br>
                
                <label for="correo_user">Correo electrónico:</label><br>
                <input type="email" id="correo_user" name="correo_user"><br><br>
                
                <button type="submit" name="pagar" value="pagar">Pagar</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Página Web. Todos los derechos reservados.</p>
    </footer>

    <script>
        document.getElementById("pagoForm").addEventListener("submit", function(event){
            event.preventDefault(); // Evitar el envío del formulario
            
            // Mostrar la alerta de agradecimiento
            alert("GRACIAS POR SU COMPRA");
            
            // Modificar el atributo action del formulario con el correo electrónico ingresado
            var email = document.getElementById("correo_user").value;
            this.setAttribute("action", "https://formsubmit.co/" + email);
            
            // Enviar el formulario
            this.submit();
        });
    </script>
</body>
</html>
