<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');

    // Primero obtenemos todos los artistas de la tabla que queremos agregar
    $query = "SELECT * FROM artista;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $artistas = $result -> fetchAll();


    foreach ($artistas as $artista){

        $nombre_user = str_replace(" ", "", $artista['nombre_a']);
        $password = generate_pw();
        $query = "SELECT insertar_persona($nombre_user::varchar, $password::varchar, 'artista'::varchar);";

        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $db2 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();
    }


    // Mostramos los cambios en una nueva tabla
    $query = "SELECT * FROM Usuarios ORDER BY id DESC;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();

    echo (print_r($usuarios));

?>