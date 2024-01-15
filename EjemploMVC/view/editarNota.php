<?php
$id = $titulo = $contenido = "";

if(isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if(isset($dataToView["data"]["titulo"])) $titulo = $dataToView["data"]["titulo"];
if(isset($dataToView["data"]["contenido"])) $contenido = $dataToView["data"]["contenido"];

?>
<div>
	<?php



	    if(isset($_GET["response"]) and $_GET["response"] === true) {

            if ( isset($_REQUEST['id'] ) && $_REQUEST['id'] != '') {

                echo "Edicion realizada correctamente";

            } else {

                echo " Creacion Realizada Correctamente";

            }
        }
	?>
<!--            <div>-->
<!--                --><?php //echo ($_GET['response'] === true) ? 'Edición' : 'Creación'; ?><!-- realizada correctamente.-->
<!--                <a href="index.php?controller=ControladorNota&action=list">Volver al listado</a>-->
<!--            </div>-->
	<?php

	   // }
	?>

	<form method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div>
			<label>Título</label>
			<input type="text" name="titulo" value="<?php echo $titulo; ?>" />
                <!-- <?php //echo"A BUENO:".$titulo?>-->
		</div>
		<div>
			<label>Contenido</label>
			<textarea style="white-space: pre-wrap;" name="contenido"><?php echo $contenido; ?></textarea>
		</div>
            <input type="submit"
                   formaction="index.php?controller=ControladorNota&action=save<?php echo (isset($_GET['id'])
                       ? '&edition=true" value="Editar"' : '" value="Crear"')?>"
                   >
<!--		<input type="submit" value="Guardar" />-->
		<a href="index.php?controller=ControladorNota&action=list">Cancelar</a>
	</form>
</div>
<?php
//}