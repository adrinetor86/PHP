
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form>
<?php

$contadorVisitas=1;

if(isset($_COOKIE["Visita"])){
    $contadorVisitas=$_COOKIE['Visita']+1; //Pilla el valor de [Visita] y le suma 1
    setcookie("Visita",$contadorVisitas);//crea la cookie con el nuevo valor
    echo "Es tu visita numero ".$_COOKIE['Visita']+1;

}else{
    setcookie("Visita",$contadorVisitas);//Crea la cookie
    echo "Es tu primera visita";   
}

if(isset($_REQUEST['Resetear'])){
    
  
  setcookie("Visita",-1,time()-1);
  
 header("location:Ejercicio1.php");
}

?>
<br><button type="submit" name="Resetear">Resetear</button>


<?php

?>
</form>
</body>
</html>