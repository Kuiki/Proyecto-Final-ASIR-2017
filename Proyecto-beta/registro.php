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
			<span>Usuario:</span><input type="text" name="Usuario" required>
			<span>Nombre:</span><input type="text" name="Nombre" required>
			<span>Apellidos:</span><input type="text" name="Apellidos">
			<span>Correo Electrónico:</span><input type="email" name="Correo" required>
			<span>Contraseña:</span><input type="password" name="Contraseña" required>
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
		$numero=rand(100,999);

		if($numero<10){
			$numero="00".$numero;
		}elseif ($numero<100) {
			$numero="0".$numero;
		}
		$codusuario=$letusuario.$numero;

		$consulta2="INSERT INTO USUARIOS VALUES('".mb_strtoupper($codusuario)."','".$_POST['Usuario']."','".ucwords($_POST['Nombre'])."','".ucwords($_POST['Apellidos'])."','".$_POST['Sexo']."','".$_POST['Nacimiento']."','".$_POST['Correo']."','Estandar','".md5($_POST['Contraseña'])."')";

		$resultado2=mysqli_query($conexion,$consulta2);
		mysqli_close($conexion);

		echo "<script>
				alert('Usuario Creado');
				var pagina='http://localhost/Proyecto_IAW/Proyecto-beta/principal.php'
				function redireccionar(){
				location.href=pagina;
				} 
				setTimeout ('redireccionar()', 500);
		</script>";



		?>
<?php endif ?>
</body>
</html>


