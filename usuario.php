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
}
?>