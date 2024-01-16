<div>
	<div>

<!--        index.php?controller=ControladorNota&Action=list-->

		<a href="http://localhost/2DAW/PHP/EjemploMVC/index.php<?php echo "/ControladorNota/edit"?>">Crear nota</a>
<!--        --><?php //echo "/".$_GET['controller'].'/'.$_GET['action'];?>

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
                    </div>
                </div>
                <?php
            }
        }else{
	?>
            <div>
                Actualmente no existen notas.
            </div>
	<?php
	    }
	?>
</div>