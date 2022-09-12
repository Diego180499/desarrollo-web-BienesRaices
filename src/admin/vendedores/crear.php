<?php
    require '../../../includes/app.php';

    use App\Vendedor;

    $autenticado = estaAutenticado();
    
    if(!$autenticado){
        header("Location:/bienesraices/src/");
    }

    $errores = []; //errores de autenticacion / validacion

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $vendedor = new Vendedor($_POST);
        $errores = $vendedor->validarDatos();
        
        if(empty($errores)){
            $resultado = $vendedor->guardar();

            if($resultado){
                //SI LA INSERCIÓN SE HIZO BIEN, ME REDIRECCIONA A OTRA PÁGINA 
                header('Location:/bienesraices/src/admin/index.php?resultado=1');
            }else{
                echo 'error al insertar';
            }
        }
    }

    
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Ingresar Vendedor</h1>
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
        <form class="formulario" method="POST">
            <fieldset>
                <legend>Datos Vendedor</legend>
                <label for="id">Id Vendedor</label>
                <input type="text" name="id" id="id" placeholder="Id Vendedor"
                value="<?php echo $vendedor->id ?? ""?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Vendedor"
                value="<?php echo $vendedor->nombre ?? ""?>">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido Vendedor"
                value="<?php echo $vendedor->apellido ?? ""?>">
                <label for="telefono">Teléfono</label>
                <input type="number" name="telefono" id="telefono"
                value="<?php echo $vendedor->telefono ?? ""?>">
                <input class="boton-verde" type="submit" value="Crear Vendedor">
            </fieldset>
        </form>
    </main>






<?php incluirTemplate('footer'); ?>
<script src="/bienesraices/build/js/bundle.min.js"></script>