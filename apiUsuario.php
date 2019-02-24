<?php

include_once 'usuario.php';

class ApiUsuarios{

    private $imagen;
    private $error;

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

        echo json_encode(array('mensaje' => $mensaje));

    }

    function add($item){

        $usuario = new Usuario();

        $res = $usuario->nuevoUsuario($item);

        $this->exito('nuevo usuario registrado');
    }

    function exito($mensaje){

        echo json_encode(array('mensaje' => $mensaje));
    }

    function subirImagen($file){

        $directorio = "imagenes/";

        $this->imagen = basename($file["name"]);
        
        $archivo = $directorio . basename($file["name"]);

        $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

        $checarSiImagen = getimagesize($file["tmp_name"]);

        if($checarSiImagen != false){
            //validando tamaño del archivo
            $size = $file["size"];

            if($size > 500000){
                $this->error = "El archivo tiene que ser menor a 500kb";
                return false;
            }else{
                //validar tipo de imagen
                if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "png"){
                    // se validó el archivo correctamente
                    if(move_uploaded_file($file["tmp_name"], $archivo)){
                        //echo "El archivo se subió correctamente";
                        return true;
                    }else{
                        $this->error = "Hubo un error en la subida del archivo";
                        return false;
                    }
                }else{
                    $this->error = "Solo se admiten archivos jpg/jpeg";
                    return false;
                }
            }
        }else{
            $this->error = "El documento no es una imagen";
            return false;
        }
    }

    function getImagen(){

        return $this->imagen;
    }

    function getError(){
        return $this->error;
    }
}
?>