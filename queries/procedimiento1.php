<?php

  // Nos conectamos a las bdds
  require("../config/conexion.php");
  include('../templates/header.html');

  // Primero obtenemos todos los pokemons de la tabla que queremos agregar
  $query = "SELECT * FROM productoras;";
  $result = $db -> prepare($query);
  $result -> execute();
  $productoras = $result -> fetchAll();


  foreach ($productoras as $productora){

      // Luego construimos las querys con nuestro procedimiento almacenado para ir agregando esas tuplas a nuestra bdd objetivo
      // Hacemos una verificacion para ver si el pokemon es legendario porque ese parámetro no se comporta muy bien entre php y sql
      // asi que lo agregamos manualmente al final (por eso los FALSE o TRUE)

      
      $query = "SELECT usuario_productora('$productora[0]'::varchar);";
      

      // Ejecutamos las querys para efectivamente insertar los datos
      $result = $db2 -> prepare($query);
      $result -> execute();
      $result -> fetchAll();
  }


  // Mostramos los cambios en una nueva tabla
  $query = "SELECT * FROM usuarios ORDER BY id;";
  $result = $db2 -> prepare($query);
  $result -> execute();
  $usuarios = $result -> fetchAll();

?>
<table align="center">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
    </tr>
  <?php
    foreach ($usuarios as $usuario) {
        echo "<tr> <td>$usuario[0]</td> <td>$usuario[1]</td> </tr>";
    }
  ?>
	</table>
</html>
