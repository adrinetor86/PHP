<div>
	<div>

		<a href="http://localhost/2DAW/PHP/EjemploMVC/index.php<?php echo "/ControladorNota/edit"?>">Crear nota</a>

		<hr/>
	</div>
	<?php
        if(count($dataToView["data"])>0){
            foreach($dataToView["data"] as $note){
                ?>
                <div>
                    <div>
                        <h5 ><?php echo $note['titulo']; ?></h5>
                        <div><?php echo nl2br($note['contenido']); ?></div>
                        <hr/>

                        <a href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/edit/<?php echo $note['id']; ?>" >Editar</a>

                        <a href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/confirmDelete/<?php echo $note['id']; ?>">Eliminar</a>

                        <a href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/imprimir/<?php echo $note['id']; ?>">Imprimir</a>
                    </div>
                </div>
                <?php
            }

            if(isset($_GET['pagina']) && $_GET['pagina']>1)
                echo "<a href=\"http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/" . ($_GET['pagina']-1) ."\">anterior </a>";
            if(isset($_GET['siguiente']) && $_GET['siguiente'] == true)
                echo "<a href=\"http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/" . ($_GET['pagina']+1) ."\">siguiente </a>";


        }else{
	?>
            <div>
                Actualmente no existen notas.
            </div>
	<?php
	    }
	?>
</div>