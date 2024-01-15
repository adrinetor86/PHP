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

    session_start();

    foreach($_REQUEST as $key => $value) {
     
      $_SESSION[$key] = $value;
      //echo $_SESSION[$key];
    }
    
    echo "<table border=\'1px\'>";
    
    foreach($_SESSION as $key => $value) {
        if ($key !== "_ijt" && $key !== "_ij_reload") {


            echo '<tr>';
            echo '<th>' . $key . '</th>';

            if (is_array($value)) {


                echo '<td>' . implode(", ", $value) . "</td>";//Convierto el array a un string

            } else {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
    }
    
    echo '</table>';
    ?>
    </form>
</body>
</html>