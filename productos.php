<!DOCTYPE html>
<html lang="es">
<head>
 	<meta charset="UTF-8">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />	
	<title>Sin título 1</title>
	<link rel="stylesheet" href="style.css">
</head>

<body class="fondo-productos">
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
        <div>
        <div id="carrito" class="carrito" style="display: inline-block">
    <button id="btn-carrito">Carrito</button>
    <div id="contenido-carrito" class="contenido-carrito">
        <h3>Carrito de compras</h3>
        <ul id="lista-carrito"></ul>
        <button id="btn-pagar">Pagar</button>
    </div>
	</div> 
        <div class="usuario" style="display: inline-block; margin-left: 20px;" >
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
        </div>
    </header>
        <div class="barra" >
           <h1 >Productos</h1>
        </div>
        <div class="cont">
        	<div class="contenedor-filtros">
        	<form action="productos.php" method="POST">
        		<h2>Filtros</h2>
        		<div style="margin-bottom: 10px;">
        		<label for="ord">Ordenar por:</label>
					<select name="ord" id="ord">
						<option value="Def">Default</option>
	    				<option value="Menor">Precio menor a mayor</option>
	  					<option value="Mayor">Precio mayor a menor</option>
  		 		</select>
  		 		</div>
  		 		<div style="margin-bottom: 10px;">
  		 		<label for="Mostrar">Mostrar:</label>
					<select name="Mostrar" id="Mostrar">
						<option value="Todos">Todos</option>
	    				<option value="Llavero">Llaveros</option>
	  					<option value="Pulsera">Pulseras</option>
  						<option value="Arete">Aretes</option>
  						<option value="Collar">Collares</option>
  		 		</select>
  		 		</div>
  		 		<button style="width: 80%;">Filtrar</button>
  		 		</form>
        	</div>
   
        	<div class="contenedor-productos">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "log_pag";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        	$orden = $_POST['ord'];
    		$mostrar = $_POST['Mostrar'];		
			if ($orden == "Menor"){
				if($mostrar != "Todos"){
					$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos WHERE etiqueta = '$mostrar' ORDER BY precio ASC";
					$result = $conn->query($sql);
				}
				else{
					$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos ORDER BY precio ASC";
					$result = $conn->query($sql);
				}
			}
			elseif ($orden == "Mayor"){
				if($mostrar != "Todos"){
					$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos WHERE etiqueta = '$mostrar' ORDER BY precio DESC";
					$result = $conn->query($sql);
				}
				else{
					$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos ORDER BY precio DESC";
					$result = $conn->query($sql);
				}
			}
			else{
				if($mostrar != "Todos"){
					$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos WHERE etiqueta = '$mostrar'";
					$result = $conn->query($sql);
				}
				else{
					$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos";
        		$result = $conn->query($sql);
				}
			}
		}
		else {
        	$sql = "SELECT nombre, descripcion, precio, etiqueta, disponibilidad, img FROM productos";
        	$result = $conn->query($sql);
		}
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            	if ($row["disponibilidad"] == 1) {
            		
                		echo '<div class="product">';
                		echo '<img src="' . $row["img"] . '" alt="' . $row["nombre"] . '">';
                		echo '<h2>' . $row["nombre"] . '</h2>';
                		echo '<p>$' . $row["precio"] . '</p>';
                		echo '<button class="agregar-carrito" data-producto="' . $row["nombre"] . '" data-precio="' . $row["precio"] . '">Agregar al carrito</button>';
                		echo '</div>';
            		
            	}
            }
        } else {
            echo "0 resultados";
        }
        $conn->close();
        ?>
        
    </div>
</div>
	   
<script src="script.js"></script>        
    <footer>
    	<p>&copy; 2024 Página Web. Todos los derechos reservados.</p>
  	</footer>

</body>

</html>
