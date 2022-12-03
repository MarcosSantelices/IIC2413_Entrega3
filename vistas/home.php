<?php

    require("../config/conexion.php");
    include('../templates/header.html');

    $user->getNombre()
    $query = "SELECT DISTINCT asiste, tour.nombre_t FROM asiste, tour WHERE asiste.nombre_a = $user AND tour.nombre_t = asiste.nombre_e;";
    $result = $db -> prepare($query);
    $result -> execute();
    $eventos = $result -> fetchAll();

    $query2 = "SELECT asiste, tour.nombre_t, FROM asiste, tour LEFT JOIN tour ON tour.nombre_t = asiste.nombre_e WHERE tour.nombre_t IS NULL AND asiste.nombre_a = $user;";
    $result2 = $db -> prepare($query2);
    $result2 -> execute();
    $eventos2 = $result2 -> fetchAll();

    $query3 = "SELECT DISTINCT asiste.nombre_a, asiste.nombre_e FROM asiste WHERE asiste.nombre_e IN (SELECT nombre_e FROM asiste WHERE asiste.nombre_a = $user) AND asiste.nombre_a != $user;"
    $result3 = $db -> prepare($query3);
    $result3 -> execute();
    $eventos3 = $result3 -> fetchAll();

    $query4 = "SELECT DISTINCT *  FROM e_cortesia WHERE nombre_a = $user;"
    $result4 = $db -> prepare($query4);
    $result4 -> execute();
    $eventos4 = $result4 -> fetchAll();

    $query5 = "SELECT hotel, tipo_traslado FROM hyt_f WHERE nombre_a = $user;"
    $result5 = $db -> prepare($query5);
    $result5 -> execute();
    $eventos5 = $result5 -> fetchAll();

?>

<!-- fuente: https://github.com/marcosrivasr/Curso-PHP-MySQL/blob/master/36.%20sesiones/tutorial/vistas/home.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="styles/mystyles.css">
</head>
<body>
    <div id="menu">
        <ul>
            <li>Home</li>
            <li class="cerrar-sesion">
                <a href="includes/logout.php">Cerrar sesión</a>
            </li>
        </ul>
    </div>

    <section>
        <h1>Bienvenido <?php echo $user; ?> </h1>
    </section>

    <table class='table'>
            <thead>
                <tr>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Recinto</th>
                <th>Artista</th>
                <th>Tour</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query as $row) {
                    echo "<tr> <td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td> <td>$row[3]</td> <td>$row[4]</td> </tr>";
                }
                foreach ($query2 as $row2) {
                    echo "<tr> <td>$row2[0]</td> <td>$row2[1]</td> <td>$row2[2]</td> <td>$row2[3]</td> <td>$row2[4]</td> </tr>";
                }
                ?>
            </tbody>
        </table>
    
        <table class='table'>
            <thead>
                <tr>
                <th>Artista</th>
                <th>Evento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query3 as $row3) {
                    echo "<tr> <td>$row[0]</td> <td>$row[1]</td> </tr>";
                }
                ?>
            </tbody>
        </table>

        <table class='table'>
            <thead>
                <tr>
                <th>Evento</th>
                <th>Asiento</th>
                <th>Artista</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query4 as $row4) {
                    echo "<tr> <td>$row[0]</td> <td>$row[1]</td> <td>$row[2]</td> </tr>";
                }
                ?>
            </tbody>
        </table>

        <table class='table'>
            <thead>
                <tr>
                <th>Hotel</th>
                <th>Traslado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($query5 as $row5) {
                    echo "<tr> <td>$row[0]</td> <td>$row[1]</td> </tr>";
                }
                ?>
            </tbody>
        </table>
    
</body>
</html>