<?php 
    require '../../../includes/app.php';
   
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    
    $vendedores = Vendedor::vendedores();


    //autenticacion de usuario
    $autenticado = estaAutenticado();
    
    if(!$autenticado){
        header("Location:/bienesraices/src/");
    }

    incluirTemplate('header');
    
    $errores = [];
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //instancia nueva de propiedad
        $propiedad = new Propiedad($_POST);

        //Generar nombre unico de imagen
        $nombreImagen = md5(uniqid( rand(), true )).".jpg";

        if($_FILES['imagen']['tmp_name']){
            //Realizar un resize con Intervention
            $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Validamos datos
        $errores = $propiedad->validarDatos();
       
        if(empty($errores)){
            //creamos carpeta imagenes
            $carpetaImagenes = "../../../imagenes";
            //vemos si la carpeta existe
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //guardamos la imagen en el servidor
            $image->save($carpetaImagenes."/".$nombreImagen);

            //guardamos en la base de datos
            $propiedad->guardar();
        }
   }
?>

<main class="contenedor seccion">
        <h1>Crear Propiedad</h1>
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
    <form class="formulario" method="POST" action="/bienesraices/src/admin/propiedades/crear.php" enctype="multipart/form-data">
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

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php echo sanitizar($propiedad->descripcion ?? ""); ?>
            </textarea>
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
            value="<?php echo sanitizar($parqueo->titulo ?? ""); ?>">

            <label for="fecha">Fecha Creación</label>
            <input type="date"  name="creacion" id="fecha"
            value="<?php echo sanitizar($propiedad->creacion ?? "" ); ?>">

            <label for="vendedor">Vendedor</label>
            <select id="select" name="vendedor">
                <option value="">--Seleccionar--</option>
                <?php 
                    foreach($vendedores as $vendedor){
                    ?>
                    <option 
                        value="<?php echo $vendedor->id; ?>">
                        <?php echo sanitizar($vendedor->nombre.' '.$vendedor->apellido) ?>
                    </option>
                    <?php
                    }
                ?>
            </select>
        </fieldset>
        <br>
        <input type="submit" class="boton boton-verde" value="Crear Propiedad">
    </form>
</main>
<?php incluirTemplate('footer'); ?>
<script src="/bienesraices/build/js/bundle.min.js"></script>