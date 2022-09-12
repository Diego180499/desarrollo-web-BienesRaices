<?php 
    //obtenemos la conexion a la base de datos
    require "../includes/app.php";
    use App\Propiedad;
    $propiedades = Propiedad::obtenerCantidadPropiedades(3);

    incluirTemplate('header_index');

?>

    <main class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="../build/img/icono1.svg" alt="icono seguridad" loading = "lazy">
                <h3>Seguridad</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Non cum incidunt possimus labore rem consequuntur dicta.
                      Accusantium, recusandae ducimus minus veniam atque
                       quidem iusto sequi nulla, eum laboriosam nam dolor?
                </p>
            </div>
            <div class="icono">
                <img src="../build/img/icono2.svg" alt="icono precio" loading = "lazy">
                <h3>Precio</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Non cum incidunt possimus labore rem consequuntur dicta.
                      Accusantium, recusandae ducimus minus veniam atque
                       quidem iusto sequi nulla, eum laboriosam nam dolor?
                </p>
            </div>
            <div class="icono">
                <img src="../build/img/icono3.svg" alt="icono tiempo" loading = "lazy">
                <h3>Tiempo</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Non cum incidunt possimus labore rem consequuntur dicta.
                      Accusantium, recusandae ducimus minus veniam atque
                       quidem iusto sequi nulla, eum laboriosam nam dolor?
                </p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y apartamentos en Venta</h2>
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
        <div class="ver-todas">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Para más información puedes contactarte con nuestros asesores.</p>
        <a href="contacto.php" class="boton-amarillo-ib">Contáctanos</a>
    </section>

    <div class="contenedor seccion blog-testimoniales">
            <section class="blog">
                <h3>Nuestro Blog</h3>
                <article class="entrada-blog">
                    <div class="imagen">
                        <picture>
                            <source srcset="../build/img/blog1.webp" type="image/webp">
                            <source srcset="../build/img/blog1.jpg" type="image/jpeg">
                            <img loading="lazy" src="../build/img/blog1.jpg" alt="texto entrada blog">
                        </picture>
                    </div>

                    <div class="texto-entrada">
                        <a href="blog.php">
                            <h4>Hermosa terraza en tu vivienda</h4>
                            <p>Escrito el: <span>18/04/2022</span> Por: <span>Diego E.</span></p>
                            <p>Consejos para construir tu terraza con los mejores estilos
                                y con los mejores materiales.
                            </p>
                        </a>
                    </div>
                </article>
                <!--SEGUNDO ARTICULO-->
                <article class="entrada-blog">
                    <div class="imagen">
                        <picture>
                            <source srcset="../build/img/blog2.webp" type="image/webp">
                            <source srcset="../build/img/blog2.jpg" type="image/jpeg">
                            <img loading="lazy" src="../build/img/blog2.jpg" alt="texto entrada blog">
                        </picture>
                    </div>

                    <div class="texto-entrada">
                        <a href="blog.php">
                            <h4>Piscina para disfrutar en familia</h4>
                            <p>Escrito el: <span>18/04/2022</span> Por: <span>Diego E.</span></p>
                            <p>Aquí te mostramos la guía para que instales tu piscina al estilo
                                que tu quieras.
                            </p>
                        </a>

                    </div>
                </article>
            </section>
            <!--FIN BLOG-->
            <section class="testimoniales">
                <h3>Testimoniales</h3>
                <div class="contenedor-testimoniales">
                    <p>
                        <span>"</span>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                         Voluptatem minus aut architecto minima aliquid aliquam,
                          dolorem animi et perferendis laborum dolorum voluptates
                           magnam quaerat natus provident iure ut quos eos?.
                           <span>"</span>
                    </p>
                    <p class="autor">- Diego Estrada.</p>
                </div>
            </section>
    </div>


    <?php incluirTemplate('footer')?>
    <script src="../build\js\bundle.min.js"></script>
</body>
</html>