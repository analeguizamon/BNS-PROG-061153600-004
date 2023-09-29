<?php
    require("utilidades/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Olimpiadas</title>
</head>
<body>
    <main>
        <section class="carta">
            <div class="emergenciasCarta"><h2>EMERGENCIAS CRITICAS</h2></div>
            <?php
            $sql = "SELECT `area`, `tiempo1` FROM `registro` WHERE `atendido` = 0 AND `emergencia` = 1";

            if ($stmt = $conexion->prepare($sql)) {
                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($area, $tiempo1);
                        for($i = 0; $i < $stmt->num_rows; $i++) {
                            $stmt->fetch();
                            $nombre = strtoupper(mysqli_query($conexion, "SELECT `sala` FROM `areas` WHERE `id`=$area")->fetch_array()[0]);
                            $numero = mysqli_query($conexion, "SELECT `numero` FROM `areas` WHERE `id`=$area")->fetch_array()[0];
                            echo "<div class='emergenciasCarta'><h3>EMERGENCIA CODIGO AZUL - $nombre $numero</h3></div>";
                        }
                    } else echo "<div class='sinEmergencias'><h3>No hay emergencias de estado critico</h3></div>";
                } else echo $stmt->error;
                $stmt->close();
            }
            ?>
        </section>
        <section class="carta">
            <div class="emergenciasCarta"><h2>LLAMADOS COMUNES</h2></div>
            <?php
            $sql = "SELECT `area`, `tiempo1` FROM `registro` WHERE `atendido` = 0 AND `emergencia` = 0";

            if ($stmt = $conexion->prepare($sql)) {
                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($area, $tiempo1);
                        for($i = 0; $i < $stmt->num_rows; $i++) {
                            $stmt->fetch();
                            $nombre = strtoupper(mysqli_query($conexion, "SELECT `sala` FROM `areas` WHERE `id`=$area")->fetch_array()[0]);
                            $numero = mysqli_query($conexion, "SELECT `numero` FROM `areas` WHERE `id`=$area")->fetch_array()[0];
                            echo "<div class='emergenciasCarta'><h3>ATENCION - $nombre $numero</h3></div>";
                        }
                    } else echo "<div class='sinEmergencias'><h3>No hay llamados normales</h3></div>";
                } else echo $stmt->error;
                $stmt->close();
            }
            ?>
        </section>
    </main>
</body>
</html>