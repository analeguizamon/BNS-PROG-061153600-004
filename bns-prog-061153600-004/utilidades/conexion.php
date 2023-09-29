<?php
try {
    $conexion = mysqli_connect("localhost", "root", "", "bns-prog-061153600-004");
    #$conexion = mysqli_connect("localhost", "id21328915_olimpiadas", "Olimpiadas.1", "bns-prog-061153600-004");

    if (!$conexion) {
        throw new Exception("No se pudo conectar a la base de datos: " . mysqli_connect_error());
    }

    mysqli_query($conexion, "SET NAMES 'utf8'");

    if (!mysqli_select_db($conexion, "bns-prog-061153600-004")) {
        throw new Exception("No se pudo seleccionar la base de datos: " . mysqli_error($conexion));
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
