<?php
    //importamos la conexion a la db
    require "../includes/app.php";

    use App\Propiedad;
    $propiedades = Propiedad::all();

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <div class="contenedor-anuncios">
            <!--INICIO DE ANUNCIO-->
            <?php
                foreach($propiedades as $propiedad){
            ?>
                    <div class="anuncio">
                        <picture>
                            <img src="../imagenes/<?php echo $propiedad->imagen ?>" alt="anuncio">
                        </picture>
                        <div class="contenido-anuncio">
                            <h3><?php echo $propiedad->titulo ?></h3>
                            <p>
                            <?php echo $propiedad->descripcion ?>
                            </p>
                            <p class="precio"><?php echo $propiedad->precio ?>
                            </p>
                            <ul class="iconos-caracteristicas">
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
                            <form action="anuncio.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                                <input class="boton boton-amarillo" type="submit" value="Ver Propiedad">
                            </form>
                        </div>
                    </div>
            <?php
                } 
            ?>
            <!--FIN DE ANUNCIO-->
            <!--*****-->
        </div>
    </main>

    <?php incluirTemplate('footer')?>
    <script src="../build\js\bundle.min.js"></script>
</body>
</html>