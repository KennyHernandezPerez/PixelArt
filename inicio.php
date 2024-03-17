<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="fondo-inicio">
	<header>
        <div class="logo">
            <img src="img/bill.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
        <div class="usuario">
        	<?php
        	session_start();
        	if(isset($_SESSION['usuario'])) {
        		echo '<p>' . $_SESSION['usuario'] . '</p>';
        	}
        	 else {
            	header("Location: index.html");
            	exit();
        	}
        	?>
        </div>
    </header>
    <div class="container">
    <div class="titulo-btn-container"> 
    <h1>La mejor tienda</h1>
    <a href="productos.php" class="productos-btn">Descubre nuestros productos</a>    
    </div>
    </div>
    <footer>
    	<p>&copy; 2024 Página Web. Todos los derechos reservados.</p>
  	</footer>
</body>
</html>
