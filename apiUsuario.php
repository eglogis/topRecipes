<?php

include_once 'usuario.php';

class ApiUsuarios{

    function getAll(){
        $usuario = new Usuario();
        $usuarios = array();
        $usuarios = array();
        $res = $usuario-> obtenerUsuarios();
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['id'],
                    "login" => $row['login'],
                    "contrasena" => $row['contrasena'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellido'],
                    "nacimiento" => $row['nacimiento'],
                    "correo" => $row['correo'],
                    "latitud" => $row['latitud'],
                    "altitud" => $row['altitud'],
                    "telefono" => $row['telefono'],
                    "foto" => $row['foto'],
                    "fechaAlta" => $row['fechaAlta'],
                    "comentarios" => $row['comentarios']
                );
                array_push($usuarios, $item);
            }
        
            //echo json_encode($usuarios);
            $this->pintarJSON($usuarios);
            
        }else{
            //echo json_encode(array('mensaje' => 'No hay elementos'));
            $this->error("No hay elementos");

        }
    }

    function getByName($login){
        $usuario = new Usuario();
        $usuarios = array();
        $usuarios = array();
        $res = $usuario-> obtenerUsuario($login);
        if($res->rowCount()){
            while ($row = $res->fetch(PDO::FETCH_ASSOC)){
    
                $item=array(
                    "id" => $row['id'],
                    "login" => $row['login'],
                    "contrasena" => $row['contrasena'],
                    "nombre" => $row['nombre'],
                    "apellido" => $row['apellido'],
                    "nacimiento" => $row['nacimiento'],
                    "correo" => $row['correo'],
                    "latitud" => $row['latitud'],
                    "altitud" => $row['altitud'],
                    "telefono" => $row['telefono'],
                    "foto" => $row['foto'],
                    "fechaAlta" => $row['fechaAlta'],
                    "comentarios" => $row['comentarios']
                );
                array_push($usuarios, $item);
            }
        
            //echo json_encode($usuarios);
            $this->pintarJSON($usuarios);
            
        }else{
            //echo json_encode(array('mensaje' => 'No hay elementos'));
            $this->error("No hay elementos");

        }
    }

    function pintarJSON($array){

        echo json_encode($array);

    }

    function error($mensaje){

        echo '<code>'. json_encode(array('mensaje' => $mensaje)). '</code>';

    }

    function add($item){

        $usuario = new Usuario();

        $res = $usuario->nuevoUsuario($item);

        $this->exito('nuevo usuario registrado');
    }

    function exito($mensaje){

        echo json_encode(array('mensaje' => $mensaje));
    }
}
?>