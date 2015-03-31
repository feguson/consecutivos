 <?php
    session_start();
    include('acceso_db.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>

  <!-- Aquí ponemos todo el código HTML de nuestra página restringida, desde <html> a </html>-->
<?php
      
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario
          // Procedemos a comprobar que los campos del formulario no estén vacíos
        if(empty(($_POST['descripcion']))) { // comprobamos que no este en blanco
            echo "No haz ingresado la descripción. <a href='javascript:history.back();'>Reintentar</a>";
        }elseif(empty($_POST['monto'])) { // comprobamos que no este en blanco
            echo "No haz ingresado el monto. <a href='javascript:history.back();'>Reintentar</a>";
        }elseif(empty($_POST['solicita'])) { // comprobamos que no este en blanco
            echo "No haz ingresado quien solicita. <a href='javascript:history.back();'>Reintentar</a>";
        }else {
            // "limpiamos" los campos del formulario de posibles códigos maliciosos
            $descripcion = mysql_real_escape_string($_POST['descripcion']);
            $monto = mysql_real_escape_string($_POST['monto']);
            $solicita = mysql_real_escape_string($_POST['solicita']);
            // comprobamos que el usuario ingresado no haya sido registrado antes
         

                $reg = mysql_query("INSERT INTO consecutivos (descripcion, monto, solicita, fecha) VALUES ('".$descripcion."', '".$monto."', '".$solicita."', NOW())");
                if($reg) {
                    echo "Datos ingresados correctamente.";
                }else {
                    echo "ha ocurrido un error y no se registraron los datos.";
                }
           
        }
    }else {
?>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Descripción:</label>
 
        <input type="text" name="descripcion" maxlength="255" />
 
        <label>Monto:</label>
 
        <input type="decimal" name="monto" maxlength="15" />
 
        <label>Solicita:</label>
 
        <input type="text" name="solicita" maxlength="50" />
 
        <input type="submit" name="enviar" value="Registrar" />
        <input type="reset" value="Borrar" />
    </form>
<?php
    }
?> 

        <!-- Aquí ponemos todo el código -->




<?php
    }else {
        echo "Estás accediendo a una página restringida, para ver su contenido debes estar registrado.
 
        <a href='acceso.php'>Ingresar</a> / <a href='registro.php'>Regitrarme</a>";
    }
?>  