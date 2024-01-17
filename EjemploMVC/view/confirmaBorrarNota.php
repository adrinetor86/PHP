<div class="row">
	<form class="form" action="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/delete" method="POST">
		<input type="hidden" name="id" value="<?php echo $dataToView["data"]["id"]; ?>" />
		<div class="alert alert-warning">
			<b>¿Confirma que desea eliminar esta nota?:</b>
			<i><?php echo $dataToView["data"]["titulo"]; ?></i>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger" />

		<a class="btn btn-outline-success" href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/<?php echo $_SESSION['numPagina']?>">Cancelar</a>
	</form>
</div>