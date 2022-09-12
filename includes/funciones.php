<?php


//el __DIR__ sirve para jalar la direccion completa del archivo
define('TEMPLATES_URL', __DIR__ .'/templates'); 
define('FUNCIONES_URL',__DIR__ .'funciones.php');

function incluirTemplate( $nombre ){
   include TEMPLATES_URL."/${nombre}.php";
}


function estaAutenticado() : bool {
   session_start();

   $autenticado = $_SESSION['login'];

   if($autenticado){
     return true;
   }
   return false;
}

function debuguear($variable){
   echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}


function sanitizar($html) : string{
   $texto = htmlspecialchars($html);
   return $texto;
}

function mostrarNotificacion($codigo){
   $mensaje = "";

   switch($codigo){

      case "1":
         $mensaje = "Registro Exitoso";
         return $mensaje;
         break;
      case "2":
         $mensaje = "Actualización Exitosa";
         return $mensaje;
         break;
      case "3": 
         $mensaje = "Eliminación Exitosa";
         return $mensaje;
         break;
      case "4":
         $mensaje = "Acción no permitida";
         return $mensaje;
         break;
      default:
         $mensaje = false;
         return $mensaje;
         break;
   }
}