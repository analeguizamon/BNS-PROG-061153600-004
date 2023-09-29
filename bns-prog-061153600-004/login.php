<?php
    require("utilidades/conexion.php");

    function crearMensaje($msg) {
        return "<p class='alerta'>$msg</p>";
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $_SESSION['FLASH'] = "";

        if(!isset($_POST['CUIL']) || empty($_POST['CUIL'])) $_SESSION['FLASH'] .= crearMensaje("El campo CUIL es obligatorio");
        else if(!is_numeric($_POST['CUIL'])) $_SESSION['FLASH'] .= crearMensaje("El CUIL ingresado es invalido");

        if(!isset($_POST['CLAVE']) || empty($_POST['CLAVE'])) $_SESSION['FLASH'] .= crearMensaje("El campo Clave es obligatorio");

        if(empty($_SESSION['FLASH'])) {
            $cuil = $_POST['CUIL'];
            $clave = md5($_POST['CLAVE']);

            $sql = "SELECT nombre, apellido, rol FROM usuarios WHERE cuil = ? AND clave = ?";

            if ($stmt = $conexion->prepare($sql)) {
                $stmt->bind_param("is", $cuil, $clave);

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($nombre, $apellido, $rol);
                        $stmt->fetch();

                        session_destroy();
                        session_start();

                        $_SESSION['CUIL'] = $cuil;
                        $_SESSION['NOMBRE'] = $nombre;
                        $_SESSION['APELLIDO'] = $apellido;
                        $_SESSION['ROL'] = $rol;

                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: app-principal.php");
                        exit;
                    } else $_SESSION['FLASH'] .= crearMensaje("CUIL o clave incorrectos");
                } else echo $stmt->error;
                $stmt->close();
            }
        }
    }
    $conexion->close();
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
    <main class="carta">
        <form action="login.php" method="POST">
            <section>
                <p>Para acceder a Plataforma ingresá tu número de CUIL sin guiones ni espacios (ej:30314067863), y tu clave.</p>
            </section>
            <section>
                <input class="selector" id="cuil" name="CUIL" type="number" placeholder="CUIL" min="0">
                <input class="selector" id="clave" name="CLAVE" type="password" placeholder="Clave">
                <div>
                    <input id="censurarClave" type="checkbox" >
                    <label for="censurarClave">Mostrar clave</label>
                </div>
                <?php
                if(isset($_SESSION['FLASH'])) {
                    echo($_SESSION['FLASH']);
                    unset($_SESSION['FLASH']);
                }
                ?>
                <a href="#"><button class="boton" type="submit">Olvide mi clave</button></a>
                <button class="boton" type="submit">Ingresar</button>
            </section>
        </form>
    </main>
    <script src="js/loginScript.js"></script>
</body>
</html>