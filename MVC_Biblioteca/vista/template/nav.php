<?php


    if(!isset($_SESSION['login'])){


        echo "<h2></h2>";

    }else{

        echo "<button>Lista Autores</button>";
        echo "<button>Lista Libros</button>";
        echo "<a href='http://localhost/2DAW/PHP/MVC_biblioteca/index.php/ControladorLogin/cerrarSesion'><button>Cerrar Sesion</button></a>";

    }
