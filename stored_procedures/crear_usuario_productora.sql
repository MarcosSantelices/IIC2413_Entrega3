CREATE OR REPLACE FUNCTION 

usuario_productora (p_nombre varchar(100))

RETURNS void AS
$$
DECLARE
    insert_statement TEXT;
    res TEXT;
BEGIN
    PERFORM dblink_connect('db2', 'dbname=grupo105e3 user=grupo105 password=grupo105');
    insert_statement = 'INSERT INTO usuarios(nombre_usuario, contrasena, tipo) VALUES(lower(replace("'||p_nombre||'", ' ', '_')), md5(random()::text), "productora");';
    res := dblink_exec('db2', insert_statement, true);
    RAISE INFO '%', res;
    perform dblink_disconnect('db2');
END
$$ language plpgsql