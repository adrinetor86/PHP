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

	<form method="POST">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<div>
			<label>Título</label>
			<input type="text" name="titulo" value="<?php echo $titulo; ?>" />

		</div>
		<div>
			<label>Contenido</label>
			<textarea style="white-space: pre-wrap;" name="contenido"><?php echo $contenido; ?></textarea>
		</div>

        <input type="submit"
               formaction="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/save<?php
               echo (!empty($id)) ? '/' . $id : ''; ?>"
               value="<?php echo (!empty($id)) ? 'Editar' : 'Crear'; ?>">



		<a href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/<?php echo $_SESSION['numPagina']?>">Cancelar</a>
	</form>
</div>
<?php
