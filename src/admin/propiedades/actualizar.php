<?php

use App\Propiedad;
use App\Vendedor;

use Intervention\Image\ImageManagerStatic as Image;

    require '../../../includes/app.php';
    
    //autenticacion de usuario
    $autenticado = estaAutenticado();
    if(!$autenticado){
        header('Location:/bienesraices/src/');
    }

    //obtenemos los vendedores
    $vendedores = Vendedor::vendedores();

    //Recibimos el id del GET desde el index
    $idPropiedad = $_GET['id'] ?? null;
    $propiedad = Propiedad::findPropiedad($idPropiedad);

    incluirTemplate('header');

    //VARIABLES PARA ALMACENAR LOS DATOS DE LA PROPIEDAD CONSULTADA
    $vendedorId = $propiedad->vendedor;
    
    //ARREGLO CON MENSAJES DE ERROR

    $errores = [];
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $propiedadActualizada = new Propiedad($_POST);
        $propiedadActualizada->setId($idPropiedad);

        //vemos si cambia de imagen
        if($_FILES['imagen']['name'] == ''){
            $propiedadActualizada->setImagen($propiedad->imagen);
        }else{
            $imagenNueva = md5(uniqid( rand(), true )).".jpg";
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            $propiedadActualizada->setImagen($imagenNueva);
        }

        $imagen = $_FILES['imagen'];
        $errores = $propiedadActualizada->validarDatos();
    
        if(empty($errores)){
            //crear carpeta
            $carpetaImagenes = "../../../imagenes";

            //vemos si la carpeta existe
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            if(!($_FILES['imagen']['name'] == '')){ //la imagen SI se va a cambiar
                unlink($carpetaImagenes."/".$propiedad->imagen);
                $image->save($carpetaImagenes."/".$propiedadActualizada->imagen);
            }

            $propiedadActualizada->actualizar();
        }
   }
?>

<main class="contenedor seccion">
        <h1>Actualizar Propiedad <?php echo $idPropiedad ?></h1>
        <a class="boton boton-verde" href="../index.php">
            Regresar a página principal
        </a>

        <?php 
            foreach($errores as $error){
        ?>
            <div class="alerta error">
                <p><?php echo $error; ?>
                </p>
            </div>
        <?php
            }
        ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" 
            value="<?php echo sanitizar($propiedad->titulo ?? ""); ?>">

            <label for="precio">Precio</label>
            <input type="number"  name="precio" id="precio" 
            value="<?php echo sanitizar($propiedad->precio ?? ""); ?>">

            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg , image/png">
            <img class="imagen-update" src="../../../imagenes/<?php echo $propiedad->imagen ?>" alt="imagen de casa">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion" value="<?php echo sanitizar($propiedad->descripcion ?? ""); ?>"><?php echo sanitizar($propiedad->descripcion ?? ""); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion De Propiedad</legend>

            <label for="habitaciones">Habitaciones</label>
            <input type="number"  name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="10" 
            value="<?php echo sanitizar($propiedad->habitaciones ?? ""); ?>">

            <label for="wc">Baños</label>
            <input type="number"  name="wc" id="wc" placeholder="Ej: 3" min="1" max="10" 
            value="<?php echo sanitizar($propiedad->wc ?? ""); ?>">

            <label for="estacionamiento">Estacionamientos</label>
            <input type="number"  name="parqueo" id="estacionamiento" placeholder="Ej: 3" min="1" max="10" 
            value="<?php echo sanitizar($propiedad->parqueo ?? ""); ?>">

            <label for="fecha">Fecha Creación</label>
            <input type="date"  name="creacion" id="fecha" 
            value="<?php echo sanitizar($propiedad->creacion ?? ""); ?>">

            <label for="vendedor">Vendedor</label>
            <select id="select" name="vendedor" ?>">
                <option value="">--Seleccionar--</option>
                <?php
                    foreach($vendedores as $vendedor){
                        ?>
                        <option
                        <?php echo $vendedorId === $vendedor->id ? 'selected' : ''; ?> 
                        value="<?php echo $vendedor->id; ?>">
                        <?php echo $vendedor->nombre.' '.$vendedor->apellido ?>
                        </option>
                    <?php    
                    }
                ?>
            </select>
        </fieldset>
        <br>
        <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">
    </form>


    </main>

<?php incluirTemplate('footer'); ?>
<script src="/bienesraices/build/js/bundle.min.js"></script>