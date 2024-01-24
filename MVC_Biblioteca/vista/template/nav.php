
<?php


    if(!isset($_SESSION['login'])){


    }else{
        echo "<nav>";
        echo "<a><button>Lista Autores</button></a>";
        echo "<a href='http://localhost/2DAW/PHP/MVC_biblioteca/index.php/ControladorLibros/listarLibros'><button>Lista Libros</button></a>";
        echo "<a href='http://localhost/2DAW/PHP/MVC_biblioteca/index.php/ControladorLogin/cerrarSesion'><button>Cerrar Sesion</button></a>";
        echo "</nav>";
    }

  ?>
</div>
