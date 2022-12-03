CREATE OR REPLACE FUNCTION

usuario_productora (p_nombre varchar(100))

RETURNS BOOLEAN AS $$

BEGIN
    insert into usuarios(nombre, contrasena, tipo) values(lower(select replace(p_nombre, ' ', '_')), SELECT md5(random()::text), 'productora');
    RETURN TRUE;

END
$$ language plpgsql