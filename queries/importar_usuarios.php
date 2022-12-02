<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');
 
    // Primero obtenemos todos los pokemons de la tabla que queremos agregar
    $query = "SELECT * FROM productoras";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $productoras = $result -> fetchAll();


    foreach ($productoras as $productora){

        // Luego construimos las querys con nuestro procedimiento almacenado para ir agregando esas tuplas a nuestra bdd objetivo
        // Hacemos una verificacion para ver si el pokemon es legendario porque ese parámetro no se comporta muy bien entre php y sql
        // asi que lo agregamos manualmente al final (por eso los FALSE o TRUE)

        $query = "SELECT importar_usuarios('$productora[0]'::varchar, '$productora[1]'::varchar, $productora[2], $productora[3])";

        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $db -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
    }

    // Mostramos los cambios en una nueva tabla
    $query = "SELECT * FROM usuarios;";
    $result = $db -> prepare($query);
    $result -> execute();
    $pokemons = $result -> fetchAll();

?>

    <body>  
        <table class='table'>
            <thead>
                <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Contrasena</th>
                <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productoras as $productora) {
                    echo "<tr>";
                    for ($i = 0; $i < 4; $i++) {
                        echo "<td>$productora[$i]</td> ";
                    }
                    echo "</tr>";
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
