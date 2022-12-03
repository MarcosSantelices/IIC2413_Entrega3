CREATE OR REPLACE FUNCTION

usuario_productora (p_nombre varchar(100))

RETURNS BOOLEAN AS $$

BEGIN
    PERFORM dblink_connect('db2', 'dbname=grupo105e3 user=grupo100 password=grupo100');
    insert_statement = insert into usuarios(nombre, contrasena, tipo) values(lower(replace(p_nombre, ' ', '_')), md5(random()::text), 'productora');
    res := dblink_exec('db2', insert_statement, true);
    RAISE INFO '%', res;
    perform dblink_disconnect('db2');
    RETURN TRUE;
END
$$ language plpgsql