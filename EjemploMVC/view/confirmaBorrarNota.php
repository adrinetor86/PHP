<div class="row">
	<form class="form" action="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/delete/"<?php echo $propiedades['parametros'][0]?> method="POST">
<!--		<input type="hidden" name="id" value="--><?php //echo $dataToView["data"]["id"]; ?><!--" />-->
        <input type="hidden" name="id" value="<?php echo $propiedades['parametros'][0]?>"/>
		<div class="alert alert-warning">
			<b>¿Confirma que desea eliminar esta nota?:</b>
                <?php echo "BORRAR ID= ".$propiedades['parametros'][0]?>
			<i><?php echo "hola".$dataToView["data"]['id']; ?></i>
		</div>
		<input type="submit" value="Eliminar" class="btn btn-danger"/>
		<a class="btn btn-outline-success" href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list">Cancelar</a>
	</form>
</div>