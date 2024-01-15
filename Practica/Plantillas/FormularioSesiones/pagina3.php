
    <?php
    include_once ("./includes/cabecera.php");

    session_start();

    echo "<table border=\'1px\'>";


    foreach ($_REQUEST as $clave=>$valor){

        $_SESSION[$clave]=$valor;
       // echo  $clave ;
    }


    foreach ($_SESSION as $clave =>$valor) {
        if ($clave !== "_ijt" && $clave !== "_ij_reload") {

            echo '<tr>';
            echo '<th>' . $clave . '</th>';

        if (is_array($valor)) {

            echo'<td>'. implode(",", $valor)."</td>";
        } else {
            echo"<td>". $valor . '<br>';
            }
        }
    }
    echo "</table>";

    include_once ("./includes/pie.php");
    ?>





