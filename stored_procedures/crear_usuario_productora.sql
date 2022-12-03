CREATE OR REPLACE FUNCTION

usuario_productora (p_nombre varchar(100))

RETURNS BOOLEAN AS $$

BEGIN
    insert into usuarios(nombre, contrasena, tipo) values(lower(replace(p_nombre, ' ', '_')), md5(random()::text), 'productora');
    RETURN TRUE;

END
$$ language plpgsql