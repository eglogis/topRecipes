<?php

    include_once 'apiUsuario.php';
    $api = new ApiUsuarios();

    if(isset($_GET['login'])){
    	$login = $_GET['login'];
    	$api->getByName($login);

    }else{

    	$api->getAll();
    }
?>