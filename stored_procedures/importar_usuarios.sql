CREATE OR REPLACE FUNCTION

--hecho para productoras

-- declaramos la función y sus argumentos
importar_usuarios (nombre varchar(100), pais varchar(30), inicio_actividades date, contacto bigint)

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- definimos nuestra función
BEGIN

    IF nombre NOT IN (SELECT nombre_usuario from usuarios) THEN
        INSERT INTO usuarios(nombre_usuario, contrasena, tipo) values(nombre, nombre, 'productora');

        -- retornamos true si se agregó el valor
        RETURN TRUE;
    ELSE
        -- y false si no se agregó
        RETURN FALSE;

    END IF;

-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
