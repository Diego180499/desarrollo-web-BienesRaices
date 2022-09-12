<?php 
    require "../includes/app.php";

    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Contáctanos</h1>
        <picture>
            <source srcset="../build/img/destacada3.webp" type="image/webp">
            <source srcset="../build/img/destacada3.jpg" type="image/jpeg">
            <img src="../build/img/destacada3.jpg" alt="foto casa">
        </picture>
        <h2>Llenar el formulario de contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Nombre completo" id="nombre">
                <label for="email">E-Mail</label>
                <input type="email" placeholder="Ingresa tu E-Mail" id="email">
                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Ingresa tu Teléfono/Celular" id="telefono">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" placeholder="Envía un mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend>Informacion sobre la Propiedad</legend>
                <label for="opciones">Vende/Compra</label>
                <select name="opciones" id="opciones">
                    <option value="" disabled selected>-Selecciona-</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Precio/Presupuesto</label>
                <input type="number" id="presupuesto" placeholder="Precio/Presupuesto">
            </fieldset>

            <fieldset class="field-contacto">
                <legend>Contacto</legend>
                <p>Como desea ser contactado:</p>
                <div class="opcion-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                    <label for="contactar-email">E-Mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligió teléfono, ingrese Fecha y Hora</p>
                <input type="date" id="fecha">
                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00" >
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer')?>
    <script src="../build\js\bundle.min.js"></script>
</body>
</html>