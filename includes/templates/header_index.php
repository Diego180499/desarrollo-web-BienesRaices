<?php
session_start();


$autenticado = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
    <title>Document</title>
</head>
<body>
    <header class="header inicio">
        <div class="contenedor contenido-header hinicio">
            <div class="barra">
                <a href="/bienesraices/src/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="logotipo Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="icono de menu responsive">
                </div>
                <div class="derecha">
                    <img class="boton-dark" src="/bienesraices/build/img/dark-mode.svg" alt="dark mode img">
                </div>
                <nav class="navegacion">
                    <a  href="/bienesraices/src/nosotros.php">Nosotros</a>
                    <a  href="/bienesraices/src/anuncios.php">Anuncios</a>
                    <a  href="/bienesraices/src/blog.php">Blog</a>
                    <a  href="/bienesraices/src/contacto.php">Contacto</a>
                    <?php 
                        if($autenticado){
                        ?>
                        <a href="/bienesraices/src/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php
                        }else{
                            ?>
                                <a href="/bienesraices/src/login.php">Iniciar Sesión</a>
                            <?php
                            }
                    ?>
                </nav>
            </div> 
            <!-- FIN DE LA BARRA DE NAVEGACION -->
            <h1>
                Venta de Casas y Apartamentos de Lujo
            </h1>
        </div>
    </header>