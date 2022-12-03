CREATE OR REPLACE FUNCTION 

usuario_productora (p_nombre varchar(100))

RETURNS void AS
$$
DECLARE
    insert_statement TEXT;
    res TEXT;
    v_state   TEXT;
    v_msg     TEXT;
    v_detail  TEXT;
    v_hint    TEXT;
    v_context TEXT;
BEGIN
    PERFORM dblink_connect('db2', 'dbname=grupo105e3 user=grupo105 password=grupo105');
    insert_statement = 'INSERT INTO usuarios(nombre_usuario, contrasena, tipo) VALUES('''||p_nombre||''', ''12345'',''productora'');';
    res := dblink_exec('db2', insert_statement, true); --lower(replace('''||p_nombre||''', '' '', ''_'')), md5(random()::text)
    RAISE INFO '%', res;
    perform dblink_disconnect('db2');

    exception when others then -- Esta línea captura el error
      SELECT dblink_disconnect('db2'); -- Cerramos la conexión
      -- A continuación obtenemos el diagnóstico más detallado del posible error y mostramos en consola la información más relevante del mismo --
      get stacked diagnostics
          v_state   = returned_sqlstate,
          v_msg     = message_text,
          v_detail  = pg_exception_detail,
          v_hint    = pg_exception_hint,
          v_context = pg_exception_context;

      raise notice E'Got exception:
          state  : %
          message: %
          detail : %
          hint   : %
          context: %', v_state, v_msg, v_detail, v_hint, v_context;

      raise notice E'Got exception:
          SQLSTATE: % 
          SQLERRM: %', SQLSTATE, SQLERRM;     

      raise notice '%', message_text;
END
$$ language plpgsql