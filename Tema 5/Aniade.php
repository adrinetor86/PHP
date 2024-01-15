
<?php

$rlnMedia=0;
$rlnArrNotas=[];
if(isset($_REQUEST['nombres'])&& isset($_REQUEST['notas'])){
$rlnArrNombres=$_REQUEST['nombres'];
$rlnArrNotas=$_REQUEST['notas'];
for($i =0;$i<count($rlnArrNotas);$i++){
$rlnMedia+=$rlnArrNotas[$i];
echo $rlnArrNombres[$i]. " ".$rlnArrNotas[$i]."<br/>";
}
}
echo "Media: " . ($rlnMedia/count($rlnArrNotas));
?>