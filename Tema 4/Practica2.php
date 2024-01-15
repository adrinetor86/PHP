<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica2</title>
    
    <form action="Practica2.php" method="get">
</head>
<body>
    <p>Primer numero: 
        <select name='numeroA'>
        <?php
        for($intCont=1;$intCont<=10;$intCont++)

        echo "<option name=$intCont>$intCont</option>";
        
        ?>
        </select>

    <p>Segundo numero</p>:
    <select name='numeroB'>
        <?php
        for($intCont=1;$intCont<=10;$intCont++)
        echo "<option name=$intCont>$intCont</option>";
        
        ?>
        </select>
    </br>
    </br>
        <input type="submit">
        <?php
        $intA=$_GET['numeroA'];
        $intB=$_GET['numeroB'];

        echo "El resultado de la multiplicacion es:".$intA*$intB .""
        ?>
</form>
</body>
</html>