<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacar letra DNI</title>
    <link rel="stylesheet" href="DNI.css">
</head>
<body>
   
    <?php
    $numero=0;
    echo"<div>";
    echo" <form>";
    echo"<label for=numeroDNI>Numero DNI</label>";
    echo"<input type=\"text\" name=\"numeroDNI\"></input> <br>";
    echo"<input type=\"submit\"></input> <br>";

    if(isset($_REQUEST['numeroDNI'])){
        $numero=$_REQUEST['numeroDNI'];
  

    $letrasDNI="TRWAGMYFPDXBNJZSQVHLCKE";
    if(filter_var($numero, FILTER_VALIDATE_FLOAT, ["options" =>["min_range"=>1000000,"max_range"=>99999999]])){

        $letrasDNI=$letrasDNI[$numero % 23];
        echo "La letra de tu dni es ".$letrasDNI;
    }else{
        echo"El dni no es valido";
    }
 };
     echo" </form>";
    echo"</div>";
    ?>
    
</body>
</html>