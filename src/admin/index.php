<?php 
//Importar funciones (conexion a DB también)
require '../../includes/app.php';
//Importamos Clases
use App\Propiedad;
use App\Vendedor;

//VEMOS SI EL USUARIO ESTA AUTENTICADO
$autenticado = estaAutenticado();
if(!$autenticado){
    header('Location:/bienesraices/src/');
}



$propiedades = Propiedad::all();
$vendedores = Vendedor::vendedores();

//RESULTADO DEL GET
    $resultado = $_GET['resultado'] ?? null;
    $mensaje = null;
    if($resultado){
        $mensaje = mostrarNotificacion($resultado);
    }
    
//RESULTADO DEL POST (ELIMINAR)
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['tipo'] == "propiedad"){
            $idPropiedad = $_POST['id'];
            $idPropiedad = filter_var($idPropiedad, FILTER_VALIDATE_INT);
            if($idPropiedad){
                Propiedad::eliminarPropiedad($idPropiedad);
            }
        }else if($_POST['tipo'] == "vendedor"){
            $idVendedor = $_POST['id'];
            Vendedor::eliminar($idVendedor);
        }
    }
    incluirTemplate('header');
?>
<main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php
            //mostramos el mensaje final del resultado
            if($mensaje){
            ?>
            <p class="notificacion"><?php echo $mensaje ?></p>
            <?php
            }
        ?>

        <a class="boton boton-verde" href="../../../bienesraices/src/admin/propiedades/crear.php">Nueva Propiedad</a>
        <a class="boton boton-verde" href="../../../bienesraices/src/admin/vendedores/crear.php">Crear Vendedor</a>
            <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($propiedades as $propiedad){
                    ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <img class="imagen-propiedad" src="../../imagenes/<?php echo $propiedad->imagen; ?>" alt="casa nueva">
                    </td>
                    <td>Q.<?php echo $propiedad->precio; ?>.00</td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input class="boton-rojo-block" type="submit" value ="Eliminar">
                        </form>
                        <a class="boton-azul-block" href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>">Editar</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
       
        <table class="tabla-vendedores">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Telefono</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($vendedores as $vendedor){
                    ?>
                    <tr>
                        <td><?php echo $vendedor->id ?></td>
                        <td><?php echo $vendedor->nombre ?></td>
                        <td><?php echo $vendedor->apellido ?></td>
                        <td><?php echo $vendedor->telefono ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input class="boton-rojo-block" type="submit" value ="Eliminar">
                            </form>
                            <a class="boton-azul-block" 
                            href="./vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>">Editar</a>
                        </td>
                    </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
</main>
<?php
//Cerrar la conexion (opcional)
    //mysqli_close($conexion);
?>

<script src="../../build/js/bundle.min.js"></script>
<?php incluirTemplate('footer')?>