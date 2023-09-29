<?php
    require("utilidades/conexion.php");

    function crearMensaje($msg) {
        return "<p>$msg</p>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();

        $_SESSION['FLASH'] = "";

        if(!isset($_POST['SALA']) || !is_numeric($_POST['SALA']) || empty($_POST['SALA'])) $_SESSION['FLASH'] .= crearMensaje("No esta seleccionada la sala");
        if(!isset($_POST['EMERGENCIA']) || !is_numeric($_POST['EMERGENCIA'])) $_SESSION['FLASH'] .= crearMensaje("No esta seleccionada el nivel de emergencia");

        if(empty($_SESSION['FLASH'])) {
            $sala = $_POST['SALA'];
            $emergencia = $_POST['EMERGENCIA'];

            $sql = "SELECT * FROM `areas` WHERE `id` = ? AND `disponible` = 0";

            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("i", $sala);

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 0) {
                        $sql = "INSERT INTO `registro` (area, emergencia, tiempo1) VALUES (?, ?, NOW())";

                        if ($stmt2 = $conexion->prepare($sql)) {
                            $stmt2->bind_param("ii", $sala, $emergencia);

                            if ($stmt2->execute()) {
                                $sql = "UPDATE `areas` SET `disponible` = '0' WHERE `areas`.`id` = ?";

                                if ($stmt3 = $conexion->prepare($sql)) {
                                    $stmt3->bind_param("i", $sala);

                                    if ($stmt3->execute()) {
                                        $_SESSION['FLASH'] = crearMensaje("PROTOCOLO CODIGO AZUL ACTIVADO");
                                    } else echo $stmt3->error;
                                    $stmt3->close();
                                }
                            } else echo $stmt2->error;
                            $stmt2->close();
                        }
                    } else $_SESSION['FLASH'] = crearMensaje("La sala seleccionada ya fue ocupada");
                } else echo $stmt->error;
                $stmt->close();
            }
        }
    }
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
        <form action="activador.php" method="POST">
            <select name="SALA" id="sala" paceholder="NO HAY SALAS DISPONIBLES">
                <?php
                $sql = "SELECT * FROM `areas`";

                if ($stmt = $conexion->prepare($sql)) {
                    if ($stmt->execute()) {
                        $stmt->store_result();
    
                        if ($stmt->num_rows > 0) {
                            $stmt->bind_result($id, $sala, $numero, $disponible);
                            for($i = 0; $i < $stmt->num_rows; $i++) {
                                $stmt->fetch();
                                $sala = ucfirst($sala);
                                if($disponible) echo "<option value=$id>$sala - $numero</option>";
                                else echo "<option disabled>$sala - $numero (OCUPADA)</option>";
                            }
                        } else echo "<option disabled selected>NO HAY SALAS DISPONIBLES</option>";
                    } else echo $stmt->error;
                    $stmt->close();
                }
                ?>
            </select>
            <p>Nivel de emergencia</p>
            <div>
                <input type="radio" name="EMERGENCIA" id="emergencia0" value="0" checked>
                <label for="emergencia0">Normal</label>
                <input type="radio" name="EMERGENCIA" id="emergencia1" value="1">
                <label for="emergencia1">Critica</label>
            </div>
            <button type="submit">Activar Emergencia</button>
        </form>
        <?php
        if(isset($_SESSION['FLASH'])) {
            echo($_SESSION['FLASH']);
            unset($_SESSION['FLASH']);
        }
        ?>
    </main>
</body>
</html>