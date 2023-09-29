<?php
    session_start();
    if(!isset($_SESSION['CUIL']) || !isset($_SESSION['ROL'])) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: index.php");
        exit;
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
    <?php
        include("utilidades/barraNavegador.php");
    ?>        
    <main>
        
    </main>
</body>
</html>