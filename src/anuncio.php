<?php 
    require "../includes/app.php";
    use App\Propiedad;


    //importamos la conexion
  
    $conexion = conectar();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idPropiedad = $_POST['id'];
        $idPropiedad = filter_var($idPropiedad, FILTER_VALIDATE_INT);
        $propiedad = Propiedad::findPropiedad($idPropiedad);
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h2>Casa en Venta</h2>
        <div class="contenido-anuncio">
            <picture>
                <!-- 
                <source srcset="../build/img/destacada.webp" type="image/webp">
                <source srcset="../build/img/destacada.jpg" type="image/jpeg">
                -->
                <img class="imagen-unica" src="../imagenes/<?php echo $propiedad->imagen ?>" alt="imagen casa">
            </picture>
            <div class="resumen-propiedad">
                <p class="precio">Q.<?php echo $propiedad->precio ?>.00</p>
                <ul class="iconos-caracteristicas iconos-anuncio">
                    <li>
                        <img src="../build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->wc ?></p>
                    </li>
                    <li>
                        <img src="../build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->parqueo ?></p>
                    </li>
                    <li>
                        <img src="../build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad->habitaciones ?></p>
                    </li>
                </ul>
                <p class="descripcion">
                    <span>Descripcion de la casa:</span>
                    </br>
                    <?php echo $propiedad->descripcion ?>
                </p>
            </div>
        </div>
    </main>

    <?php incluirTemplate('footer')?>
   <script src="../build\js\bundle.min.js"></script>
</body>
</html>