<?php

class User {

    private $nombre;
    private $username;

    public function Existe_usuario($usuario, $contra){
        $query = $this->connect()->prepare('SELECT * FROM Usuarios WHERE nombre_usuario = :usuario');
        $query->execute(['nombre_usuario'=> $usuario]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($usuario){
        $query = $this->connect()->prepare('SELECT * FROM Usuarios WHERE nombre_usuario = :usuario');
        $query->execute(['nombre_usuario'=> $usuario]);

        foreach ($query as $usuario_actual){
            $this->nombre = $usuario_actual['nombre'];
            $this->username = $usuario_actual['username'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }

}


?>