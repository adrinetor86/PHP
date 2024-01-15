<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Actividad4_1.php" method="get"> 
    <?php
    $intArrayMeses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    for($intCont=0;$intCont<count($intArrayMeses);$intCont++){
        echo $intArrayMeses[$intCont]."<input type='number' name='$intArrayMeses[$intCont]'></br>" ;
        
    } 
    ?>

    <input type='submit'></input>
    
    
    <?php

    echo"<br/>";
    $intArray=[];
    $intArrayTemp=[];
    for($intcont=0;$intcont<12;$intcont++){

        $intArray[]=isset($_GET[$intArrayMeses[$intcont]])?$_GET[$intArrayMeses[$intcont]]:1;

        echo "$intArrayMeses[$intcont] $intArray[$intcont]<br/>";
    }
    echo"<br/><br/><br/>";

    for($intcont=0;$intcont<12;$intcont++){

        $intArrayTemp[]=$intArray[$intcont];

        echo "$intArrayMeses[$intcont] $intArrayTemp[$intcont]<br/>";
    }
    echo"<br/><br/><br/>";

    for($intcont=0;$intcont<12;$intcont++){
        echo"$intArrayMeses[$intcont]";
       for($intCont2=0;$intCont2<$intArrayTemp[$intcont];$intCont2++){

        echo "🥵";
       }
       echo "<br/>";
    }
    ?>


    </form>
</body>
</html>