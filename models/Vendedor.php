<?php

namespace Model;

use Exception;

class Vendedor{

    protected static $columnasDB = ['id','nombre','apellido','telefono'];
    protected static $errores = [];
    protected static $db;
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($datos = []){
        $this->id = $datos['id']  ?? 0;
        $this->nombre = $datos['nombre']  ?? 0;
        $this->apellido = $datos['apellido']  ?? 0;
        $this->telefono = $datos['telefono']  ?? 0;   
    }

    //consultar todos los vendedores
    public static function consultarSQL($queryConsulta){
       
        $resultado = self::$db->query($queryConsulta);
        $vendedores = [];

        while($registro = $resultado->fetch_assoc()){
            $vendedor = new Vendedor($registro);
            $vendedores[] = $vendedor;
        }


        return $vendedores;
    }


    public static function vendedores(){
        $queryConsulta = "SELECT * FROM vendedor;";
        $vendedores = self::consultarSQL($queryConsulta);
        return $vendedores;
    }

    //Eliminar Vendedor
    public static function eliminar($id){
        $queryEliminar = "DELETE FROM vendedor WHERE id = ".$id.";";
        try{
            $resultado = self::$db->query($queryEliminar);

            if($resultado){
             header("location:/bienesraices/src/admin/index.php?resultado=3");
            }
        }catch(Exception){
            header("location:/bienesraices/src/admin/index.php?resultado=4");
        }
        
    }

    //Proceso de sanitizar datos
    public function atributos(){
        $atributos = [];

        foreach(self::$columnasDB as $columna){
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizar(){
        $atributos = $this->atributos();

        $sanitizados = [];

        foreach($atributos as $key => $value){
            $sanitizados[$key] = self::$db->escape_string($value);
        }

        return $sanitizados;
    }

    //Validar datos del front
    public function validarDatos(){
        if(!$this->id){
            self::$errores[] = "El ID es obligatorio";
        }
        if(!$this->nombre){
            self::$errores[] = "El  nombre es obligatorio";
        }
        if(!$this->apellido){
            self::$errores[] = "El  apellido es obligatorio";
        }
        if(!$this->telefono){
            self::$errores[] = "El  telefono es obligatorio";
        }

        return self::$errores;
    }

    //Crear un Vendedor
    public function guardar(){
        $registro = $this->sanitizar();

        $campos = "(".join(", ", array_keys($registro)).")";
        $valores = "('".join("' , '",array_values($registro))."')";
        
        $queryInsertar = "INSERT INTO vendedor ".$campos." VALUES ".$valores.";";
        $resultado = self::$db->query($queryInsertar);
        return $resultado;
    }

    //obtener un vendedor
    public static function obtenerVendedor($id){
        $queryVendedor = "SELECT * FROM vendedor WHERE id = ".$id;
        $vendedor = self::consultarSQL($queryVendedor);
        return array_shift($vendedor);
    }

    //Actualizar Vendedor
    public function actualizar(){
        $datos = $this->sanitizar();

        $queryActualizar = "UPDATE vendedor SET
        nombre = '".$this->nombre
        ."', apellido = '".$this->apellido
        ."', telefono = ".$this->telefono
        ." WHERE id = ".$this->id.";";

        $resultado = self::$db->query($queryActualizar);

        if($resultado){
            //SI LA ACTUALIZACION SE HIZO BIEN, ME REDIRECCIONA A OTRA PÁGINA 
            header('Location:/bienesraices/src/admin/index.php?resultado=2');
        }else{
            echo 'error al actualizar';
        }
    }

    public static function setDB($db){
        self::$db = $db;
    }

    public function setId($id){
        $this->id = $id;
    }
    
    
}