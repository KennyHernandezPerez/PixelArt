<?php
$servername = "b5rhowkextbchzcrjhhc-mysql.services.clever-cloud.com";
$username = "upesbtzii1wqcgnm";
$password = "n5actU9NkvH5wgN3REyJ";
$dbname = "b5rhowkextbchzcrjhhc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $des = $_POST["des"];
    $pre = $_POST["pre"];
    $foto = $_POST["foto"];
    $eti = $_POST["eti"];
    $dis = $_POST["dis"];

    $sql = "INSERT INTO productos (nombre, descripcion, precio, etiqueta, disponibilidad, img) VALUES ('$nombre','$des','$pre','$eti','$dis','$foto')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }
}

$conn->close();
?>
