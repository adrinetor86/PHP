
<?php
$rlnArrNumeros=[];
if(isset($_REQUEST['nombres'])&& isset($_REQUEST['numeros'])){
$rlnArrNombre=$_REQUEST['nombres'];
$rlnArrNumero=$_REQUEST['numeros'];
for($i =0;$i<count($rlnArrNumeros);$i++){
    echo $rlnArrNombres[$i]. " ".$rlnArrNumeros[$i]."<br/>";
    }
}


?>
