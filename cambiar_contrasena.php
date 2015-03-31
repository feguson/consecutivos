 <?php
    session_start();
    include('acceso_db.php'); // incluímos los datos de conexión a la BD
    if(isset($_SESSION['usuario_nombre'])) { // comprobamos que la sesión esté iniciada
        if(isset($_POST['enviar'])) {
            if($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) {
                echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>";
            }else {
                $usuario_nombre = $_SESSION['usuario_nombre'];
                $usuario_clave = mysql_real_escape_string($_POST["usuario_clave"]);
                $usuario_clave = md5($usuario_clave); // encriptamos la nueva contraseña con md5
                $sql = mysql_query("UPDATE usuarios SET usuario_clave='".$usuario_clave."' WHERE usuario_nombre='".$usuario_nombre."'");
                if($sql) {
                    echo "Contraseña cambiada correctamente.";
                }else {
                    echo "Error: No se pudo cambiar la contraseña. <a href='javascript:history.back();'>Reintentar</a>";
                }
            }
        }else {
?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label>Nueva contraseña:</label>
 
            <input type="password" name="usuario_clave" maxlength="15" />
 
            <label>Confirmar:</label>
 
            <input type="password" name="usuario_clave_conf" maxlength="15" />
 
            <input type="submit" name="enviar" value="Enviar" />
        </form>
<?php
        }
    }else {
        echo "Acceso denegado.";
    }
?>  