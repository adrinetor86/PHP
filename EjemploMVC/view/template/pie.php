
<?php
if(isset($_SESSION['login']) && $_SESSION['login']==true){

    echo '<a href="index.php?controller=ControladorLogin&action=cerrarSesion">Cerrar sesion</a>';
}

?>


        </div>
    </body>
</html>