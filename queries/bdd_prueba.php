<?php

    require("../config/conexion.php");
    include('../templates/header.html');

    $query = "SELECT * FROM usuarios ORDER BY id;";
    $result = $db -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();

?>

    <body>  
        <table class='table'>
            <thead>
                <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                    echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> <td>$usuario[2]</td> <td>$usuario[3]</td> </tr>";
                }
                ?>
            </tbody>
        </table>
        <footer>
            <p>
                IIC2413 - Ayudantía 3 BDD
            </p>
        </footer>

    </body>
</html>
