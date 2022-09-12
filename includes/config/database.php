<?php

function conectar(){

    $servidor = "localhost";
    $usuario = "root";
    $password = "diegousac17";
    $db = "bienes_raices";

    $db = new mysqli($servidor,$usuario,$password,$db);

    if(!$db){
        echo 'incorrecto';
        exit;
    }

    return $db;

}
