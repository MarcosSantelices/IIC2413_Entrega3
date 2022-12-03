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
<?php

include_once '../includes/user.php';
include_once '../includes/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    //echo 'Hay sesión';

    $user->setUser($userSession->get_current_user());
    include_once '../vistas/home.php';

} else if(isset($_POST['username'])){
    // echo 'Validación de login';

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    if ($user->Existe_usuario($userForm, $passForm)){
        // echo 'Usuario válidado';

        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once '../vistas/home.php';

    } else {
        $errorLogin = 'Nombre de usuario y/o contraseña incorrectos';
        include_once '../vistas/login.php';
    }


} else {
    // echo 'Login';
    include_once '../vistas/login.php';
}


?>
</html>
