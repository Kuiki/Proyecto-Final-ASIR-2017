<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form{
			width: 600px;
			margin: 0px auto;
		}

		fieldset{
			padding: 80px;
			margin: 50px 0px;
		}
		span{
			display: inline-block;
			width: 200px;
		}

		input{
			display: inline-block;
			margin: 5px;
		}
		#botones{
			width: 200px;
			padding: 5px;
			margin: 0px auto;
		}
	</style>
</head>
<body>
<?php if (!isset($_POST['Nombre'])): ?>

	<form method="post">
		<fieldset>
			<legend><h2>Nueva Cuenta</h2></legend>
			<span>Usuario:</span><input type="text" name="Usuario">
			<span>Nombre:</span><input type="text" name="Nombre">
			<span>Apellidos:</span><input type="text" name="Apellidos">
			<span>Correo Electrónico:</span><input type="text" name="Correo">
			<span>Contraseña:</span><input type="password" name="Contraseña">
			<span>Sexo:</span><input type="radio" name="Sexo" value="H">Hombre<input type="radio" name="Sexo" value="M">Mujer<br>
			<span>Fecha Nacimiento</span><input type="date" name="Nacimiento" value="">
			<br></br>
			<div id="botones">
			<input type="submit" name="Nueva" value="Crear Cuenta"><input type="button" name="Cancelar" value="Cancelar">
			</div>
		</fieldset>

	</form>

<?php else: ?>
	<?php 
		$conexion=mysqli_connect("localhost","root","jallmay1995","blog");
		$letusuario=substr($_POST['Nombre'], 0,2).substr($_POST['Apellidos'], 0,2);
		$consulta1="SELECT COUNT(*) FROM USUARIOS";
		$resultado1=mysqli_query($conexion,$consulta1);
		$fila1=mysqli_fetch_row($resultado1);
		$numero=(int)$fila1['0']+1;


		if((int)$numero<10){
			$numero="00".$numero;
		}elseif ((int)$numero<100) {
			$numero="0".$numero;
		}elseif((int)$numero<1000){
			$numero;
		}else{
			echo "Ha sobrepasado el numero maximo de usuarios";
		}

		$codusuario=$letusuario.$numero;

		$consulta2="INSERT INTO USUARIOS VALUES('".mb_strtoupper($codusuario)."','".$_POST['Usuario']."','".ucwords($_POST['Nombre'])s."','".ucwords($_POST['Apellidos'])."','".$_POST['Sexo']."','".$_POST['Nacimiento']."','".$_POST['Correo']."','Estandar','".md5($_POST['Contraseña'])."')";
s
	 ?>
<?php endif ?>
</body>
</html>


