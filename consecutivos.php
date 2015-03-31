<?php
    session_start();
    include('acceso_db.php'); // incluímos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesión
    if(isset($_SESSION['usuario_nombre'])) {
?>

<?php 

$query = "SELECT * FROM consecutivos";
$resultado = mysql_query($query);
echo "<br><br><table style='width:100%'>";
while ($fila = mysql_fetch_array($resultado)){
echo "<tr style='border-bottom:1px solid #eee'>";
echo "<td align='center' style='padding:7px 0px'";
echo "<p>$fila[descripcion]";
echo "</td>";
echo "</tr>";
}
echo "</table>";

 ?>

 <?php
    }else {
        echo "Estás accediendo a una página restringida, para ver su contenido debes estar registrado.
 
        <a href='acceso.php'>Ingresar</a> / <a href='registro.php'>Regitrarme</a>";
    }
?>  