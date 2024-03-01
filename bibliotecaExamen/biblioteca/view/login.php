<?php
$strCorreo = $strPassword = $strMensaje = "";

if(isset($dataToView["data"]["correo"])) $strCorreo = $dataToView["data"]["correo"]; // se puede hacer con _REQUEST
if(isset($dataToView["data"]["password"])) $strPassword = $dataToView["data"]["password"];
if(isset($dataToView["data"]["mensaje"])) $strMensaje = $dataToView["data"]["mensaje"];

?>
    <h2><?php echo $strMensaje; ?></h2>

        <form action="<?=DEFAULT_ROOT?>/ControladorUsuario/login/" method="POST">

		<div>
			<label>Email</label>
			<input type="text" name="correo" value="<?php echo $strCorreo; ?>" />
		</div>
		<div>
			<label>Password</label>
            <input type="text" name="password" value="<?php echo $strPassword; ?>" />
		</div>
		<input type="submit" value="Enviar" />
	</form>
</div>