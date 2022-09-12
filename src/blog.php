<?php 
    require "../includes/app.php";

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Nuestro Blog</h1>
        <section class="blog contenedor-blog">
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="../build/img/blog1.webp" type="image/webp">
                        <source srcset="../build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="../build/img/blog1.jpg" alt="texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
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
                    <a href="entrada.html">
                        <h4>Piscina para disfrutar en familia</h4>
                        <p>Escrito el: <span>18/04/2022</span> Por: <span>Diego E.</span></p>
                        <p>Aquí te mostramos la guía para que instales tu piscina al estilo
                            que tu quieras.
                        </p>
                    </a>

                </div>
            </article>
            <!--TERCER ARTICULO-->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="../build/img/blog3.webp" type="image/webp">
                        <source srcset="../build/img/blog3.jpg" type="image/jpeg">
                        <img loading="lazy" src="../build/img/blog3.jpg" alt="texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Piscina para disfrutar en familia</h4>
                        <p>Escrito el: <span>18/04/2022</span> Por: <span>Diego E.</span></p>
                        <p>Aquí te mostramos la guía para que instales tu piscina al estilo
                            que tu quieras.
                        </p>
                    </a>

                </div>
            </article>
            <!--CUARTO ARTICULO-->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="../build/img/blog4.webp" type="image/webp">
                        <source srcset="../build/img/blog4.jpg" type="image/jpeg">
                        <img loading="lazy" src="../build/img/blog4.jpg" alt="texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
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
    </main>
    <?php incluirTemplate('footer')?>
    <script src="../build\js\bundle.min.js"></script>
</body>
</html>