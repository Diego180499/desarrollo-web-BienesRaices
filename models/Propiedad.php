<?php

namespace Model;

class Propiedad{

    protected static $db;
    protected static $columnasDB = ['id','titulo', 'precio', 'imagen',
     'descripcion','habitaciones','wc','parqueo','creacion','vendedor'];
    
    protected static $errores = [];

    public  $id;
    public  $titulo;
    public  $precio;
    public  $imagen;
    public  $descripcion;
    public  $habitaciones;
    public  $wc;
    public  $parqueo;
    public  $creacion;
    public  $vendedor;

    public function __construct($datos = [])
    {
        $this->id = $datos['id'] ?? 0;
        $this->titulo = $datos['titulo'] ?? "";
        $this->precio = $datos['precio'] ?? "";
        $this->imagen = $datos['imagen'] ?? "";
        $this->descripcion = $datos['descripcion'] ?? "";
        $this->habitaciones = $datos['habitaciones'] ?? 0;
        $this->wc = $datos['wc'] ?? 0;
        $this->parqueo = $datos['parqueo'] ?? 0;
        $this->creacion = $datos['creacion'] ?? date('Y/m/d');
        $this->vendedor = $datos['vendedor'] ?? 0;
    }

    public static function setDb($database){
        self::$db = $database;
    }


    public function guardar(){

        //Sanitizar datos
        $datosLimpios = $this->sanitizarDatos();

        //titulo, precio, imagen, descripcion, habitaciones, wc, parqueo, creacion, vendedor
        $campos = "(".join(', ',array_keys($datosLimpios)).")"; //convierte un arreglo en un string :D
        $valores = "('".join("' , '",array_values($datosLimpios))."')";
    

        $queryInsert = "INSERT INTO propiedad $campos VALUES $valores";

        $resultado = self::$db->query($queryInsert); //INSERTAMOS LOS DATOS A LA BASE DE DATOS
    
        if($resultado){
            //SI LA INSERCIÓN SE HIZO BIEN, ME REDIRECCIONA A OTRA PÁGINA 
            header('Location:/bienesraices/src/admin/index.php?resultado=1');
        }else{
            echo 'error al insertar';
        }
    }

    //Identificar y unir los datos de la DB
    public function atributos(){

        $atributos = [];

        foreach(self::$columnasDB as $columna){
            if($columna == 'id'){
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    //limpiamos los datos
    public function sanitizarDatos(){

        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
       
    }

    //subida de archivos
    //asignar imagen
    public function setImagen($imagen){
        
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //validacion de datos
    public static function getErrores(){
        return self::$errores;
    }

    public function validarDatos(){
        if(!$this->titulo){
            self::$errores [] = "Debes añadir un título";
        }

        if(!$this->precio){
            self::$errores [] = "Debes añadir un precio";
        }

        if(!$this->descripcion){
            self::$errores [] = "Debes añadir una descripción";
        }

        if(!$this->habitaciones){
            self::$errores [] = "Debes añadir una cantidad de Habitaciones";
        }

        if(!$this->wc){
            self::$errores [] = "Debes añadir una cantidad de baños";
        }

        if(!$this->parqueo){
            self::$errores [] = "Debes añadir una cantidad en parqueo";
        }

        if(!$this->vendedor){
            self::$errores [] = "Debes añadir un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "Debe Seleccionar una imagen";
        }

        return self::$errores;
    }

    //trae todas las propiedades
    public static function all(){
        $queryConsultar = "SELECT * FROM propiedad;";
        $resultado = self::consultarSQL($queryConsultar);
        return $resultado;
    }

    public static function consultarSQL($queryConsulta){
        //Consultar la base de datos
        $resultado = self::$db->query($queryConsulta);

        //Iterar los resultados
        $propiedades = [];
        while($registro = $resultado->fetch_assoc()){
            $propiedades [] = self::crearPropiedad($registro); //guardamos las propiedades consultadas
        }
        
        return $propiedades;
    }

    protected static function crearPropiedad($registro){

        $propiedad = new Propiedad($registro);
        return $propiedad;
    }


    //BUSCAR UNA PROPIEDAD

    public static function findPropiedad($id){
        $queryPropiedad = "SELECT * FROM propiedad WHERE id = ".$id;
        $registro = self::consultarSQL($queryPropiedad);
        return array_shift($registro); //nos retoran el primer elemento del arreglo
    }

    //Actualizar Propiedad

    public function actualizar(){
         //Sanitizar datos
        $datosLimpios = $this->sanitizarDatos();

        $queryAcutalizar = "UPDATE propiedad SET titulo = '".$datosLimpios['titulo']."'"
        .", precio = ".$datosLimpios['precio']
        .", imagen = '".$datosLimpios['imagen']."'"
        .", descripcion = '".$datosLimpios['descripcion']."'"
        .", habitaciones = ".$datosLimpios['habitaciones']
        .", wc = ".$datosLimpios['wc']
        .", parqueo = ".$datosLimpios['parqueo']
        .", creacion = '".$datosLimpios['creacion']."'"
        .", vendedor = ".$datosLimpios['vendedor']
        ." WHERE id = ".$this->id;
        
        $resultado = self::$db->query($queryAcutalizar);

        if($resultado){
            //SI LA ACTUALIZACION SE HIZO BIEN, ME REDIRECCIONA A OTRA PÁGINA 
            header('Location:/bienesraices/src/admin/index.php?resultado=2');
        }else{
            echo 'error al actualizar';
        }
    }

    //ELIMINAR UNA PROPIEDAD
    public static function eliminarPropiedad($id){
        $propiedad = self::findPropiedad($id);
        $nombreImagen = $propiedad->imagen;
        unlink("../imagenes/${nombreImagen}");

        $queryEliminar = "DELETE FROM propiedad WHERE id = ".$id;
        $resultado = self::$db->query($queryEliminar);

        if($resultado){
            header("location:/bienesraices/src/admin/index.php?resultado=3");
        }
    }

    public static function obtenerCantidadPropiedades($cantidad){
        $queryLimit = "SELECT * FROM propiedad LIMIT ".$cantidad.";";
        $propiedades = self::consultarSQL($queryLimit);
        return $propiedades;
    }

    public function setId($id){
        $this->id = $id;
    }







}