<header>
        <nav>
            <ul>
                <?php
                switch($_SESSION['ROL']) {
                    case 1:
                        echo "<a href='app-usuarios'><li>Usuarios</li></a>";
                    case 2:
                        echo "<a href='app-pacientes'><li>Pacientes</li></a>";
                        echo "<a href='app-areas'><li>Areas</li></a>";
                    case 3:
                        echo "<a href='app-registro'><li>Registro</li></a>";
                        echo "<a href='app-ajustes'><li>Ajustes</li></a>";
                        echo "<a href='app-principal'><li>Principal</li></a>";
                    break;
                }
                ?>
        </ul>
    </nav>
</header>