<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    

    public function comprobarRutas(){
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            debuguear($urlActual);            
        }
    } 

    public function get($url, $funcion){
        $this->rutasGET[$url] = $funcion;
    }

}