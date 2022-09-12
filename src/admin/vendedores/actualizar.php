<?php
require '../../../includes/app.php';

use App\Vendedor;

$idVendedor = $_GET['id'];
$vendedor = Vendedor::obtenerVendedor($idVendedor);

$errores = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $vendedorActualizado = new Vendedor($_POST);
    $vendedorActualizado->setId($idVendedor);
    $errores = $vendedorActualizado->validarDatos();

    if(empty($errores)){
        $vendedorActualizado -> actualizar();
    }
}



incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Datos de Vendedor</h1>
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
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Vendedor"
                value="<?php echo $vendedor->nombre ?>">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido Vendedor"
                value="<?php echo $vendedor->apellido ?>">>
                <label for="telefono">Teléfono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Teléfono Vendedor"
                value="<?php echo $vendedor->telefono ?>">>
                <input class="boton-verde" type="submit" value="Actualizar Datos">
            </fieldset>
        </form>


    </main>




<?php incluirTemplate('footer'); ?>
<script src="/bienesraices/build/js/bundle.min.js"></script>