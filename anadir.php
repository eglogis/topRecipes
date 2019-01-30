<?php

	include_once 'apiUsuario.php';
    $api = new ApiUsuarios();

        $item = array(
            
                "login" => $_POST['login'],
                'contrasena' => $_POST['contrasena'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'nacimiento' => $_POST['nacimiento'],
                'correo' => $_POST['correo'],
                'latitud' => $_POST['latitud'],
                'altitud' => $_POST['altitud'],
                'telefono' => $_POST['telefono'],
                'foto' => $_POST['foto'],
                'comentarios' => $_POST['comentarios']
            );

         $api->add($item);
?>