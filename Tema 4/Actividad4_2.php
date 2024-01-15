<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Actividad4_2.php" method="get">
     <?php


    for($intCont=0,$intCont2=0;$intCont<20;$intCont++){
        
        $intNumero =rand(0,100);

        if($intNumero%2==0){
        $intArrPar[$intCont2]=$intNumero;
        $intCont2++;
        }else
        $intArrInp[$intCont]=$intNumero;
    }
       $intArrTotal= array_merge($intArrPar,$intArrInp);
    
        print_r($intArrPar);
        echo "inpar";
        print_r($intArrInp);
        echo"TODO </br>";
        print_r($intArrTotal)
        
     ?>
    </form>
</body>
</html>