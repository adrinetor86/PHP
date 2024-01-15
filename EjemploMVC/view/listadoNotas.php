<div>
	<div>

<!--        index.php?controller=ControladorNota&Action=list-->

		<a href="index.php<?php echo "/".$propiedades['controller'].'/edit';?>">Crear nota</a>
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
<!--                        $propiedades['controller'].'/'.$propiedades['action']-->

<!--                        index.php?controller=ControladorNota&action=edit&id=-->
                        <a href="index.php/<?php echo $propiedades['controller'].'/edit/'. $note['id']; ?>" >Editar</a>
                        <a href="index.php/ControladorNota/confirmDelete/<?php echo $note['id']; ?>">Eliminar</a>
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