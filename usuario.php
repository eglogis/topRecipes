<?php

include_once 'conexionMysql.php';

class Usuario extends DB{
    
    function obtenerUsuarios(){
        $query = $this->connect()->query('SELECT * FROM usuarios');
        return $query;
    }

    function obtenerUsuario($login){
        
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE login= :login');
        $query->execute(['login' => $login]);

        return $query;
    }

    function nuevoUsuario($usuario){

    	$query = $this->connect()->prepare('INSERT INTO usuarios (login, contrasena, nombre, apellido, nacimiento, correo, latitud, altitud, telefono, foto, comentarios) VALUES (:login, :contrasena, :nombre, :apellido, :nacimiento, :correo, :latitud, :altitud, :telefono, :foto, :comentarios)');
    	
        $query->execute(['login' => $usuario['login'], 'contrasena' => $usuario['contrasena'], 'nombre' => $usuario['nombre'], 'apellido' => $usuario['apellido'], 'nacimiento' => $usuario['nacimiento'],'correo' => $usuario['correo'], 'latitud' => $usuario['latitud'], 'altitud' => $usuario['altitud'], 'telefono' => $usuario['telefono'], 'foto' => $usuario['foto'], 'comentarios' => $usuario['comentarios'],]);

        return $query;
    }


}
?>