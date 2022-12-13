CREATE OR REPLACE FUNCTION insertar_persona (nombre varchar(100), contra varchar(100), tip varchar(20))
RETURNS void AS
$$
BEGIN
    INSERT INTO Usuarios(nombre_usuario, contrasena, tipo) VALUES (nombre, contra, tip);
END
$$ language plpgsql