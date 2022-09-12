<?php 
    //importamos la conexion
    require "../includes/app.php";
    $conexion = conectar();
    $errores = [];
    //autenticar al usuario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = mysqli_real_escape_string( $conexion , $_POST['password']);
        
        if(!$email){
            $errores [] = "El Email es obligatorio";
        }
        
        if(!$password){
            $errores [] = "El password es obligatorio";
        }

        //autenticar si el usuario existe
        if(empty($errores)){

            $queryUsuario = "SELECT * FROM usuario WHERE email = '${email}';";
            $consultaUsuario =  mysqli_query($conexion, $queryUsuario);
            
            if($consultaUsuario -> num_rows){ //como es objeto, de esa manera se accede.
                
                $usuario = mysqli_fetch_assoc($consultaUsuario);
                $autenticado = password_verify($password, $usuario['password']);
                
                if($autenticado){
                    //usamos la super globar $_SESSION
                    session_start();

                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    //nos redireccionamos a la pagina del admin
                    header("Location:/bienesraices/src/admin/");
                }else{
                    $errores [] = "La contraseña no coincide con el usuario";
                }

            }else{
                $errores [] = "El usuario no existe";
            }


        }

    }
    
    incluirTemplate('header_index');

?>

    <main class="contenedor seccion">
        <h1>Iniciar Sesión</h1>
        <?php 
        if(!empty($errores)){
            foreach($errores as $error ){
            ?>
            <div class="alerta error">
                <p><?php echo $error ?></p>
            </div>
            <?php 
            }       
        }
        ?>

        <div class="formulario-centrado">
        <form class="formulario" method="POST">
            <fieldset>
                <legend>Email / Password</legend>
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email" placeholder="Ingresa tu e-mail">
            
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Ingresa una contraseña">
            </fieldset>
            <input  class="boton-verde" type="submit" value="Ingresar">
        </form>
        </div>
        

    </main>

    <?php incluirTemplate('footer')?>
    <script src="../build\js\bundle.min.js"></script>
</body>
</html>