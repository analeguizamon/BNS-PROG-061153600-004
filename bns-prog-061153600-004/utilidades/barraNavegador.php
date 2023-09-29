<header class="navegacion">
    <nav>
        <ul>
            <?php
            switch($_SESSION['ROL']) {
                case 1:
                    echo "<a href='app-usuarios.php'><li>Usuarios</li></a>";
                case 2:
                    echo "<a href='app-pacientes.php'><li>Pacientes</li></a>";
                    echo "<a href='app-areas.php'><li>Areas</li></a>";
                case 3:
                    echo "<a href='app-registro.php'><li>Registro</li></a>";
                    echo "<a href='app-ajustes.php'><li>Ajustes</li></a>";
                    echo "<a href='app-principal.php'><li>Principal</li></a>";
                    break;
            }
            ?>
        </ul>
    </nav>
</header>