<?php 
    require "../includes/app.php";

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h2>Nosotros</h2>
        <div class="contenedor-nosotros">
            <picture>
                <source srcset="../build/img/nosotros.webp" type="image/webp">
                <source srcset="../build/img/nosotros.jpg" type="image/jpeg">
                <img src="../build/img/nosotros.jpg" alt="nosotros">
            </picture>

            <div class="texto-nosotros">
                <p>
                    <span>25 años de Experiencia</span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Autem aut necessitatibus voluptatem? Molestias alias odit
                    aliquid voluptate ipsa numquam aliquam. Consectetur quidem
                    ea dolore corporis dolorum nesciunt? Perspiciatis, iure sed!
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Autem aut necessitatibus voluptatem? Molestias alias odit
                    aliquid voluptate ipsa numquam aliquam. Consectetur quidem
                    ea dolore corporis dolorum nesciunt? Perspiciatis, iure sed!
                </p>
            </div>
        </div>
    </main>

    <?php incluirTemplate('footer')?>
    <script src="../build\js\bundle.min.js"></script>
</body>
</html>