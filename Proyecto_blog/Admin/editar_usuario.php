<?php 
	include '../conexion.php';
	if(empty($_SESSION['Usuario'])){
		echo "<h1>Lo siento, no puedes entrar ...</h1>";
		session_destroy();
		exit();
	}else{
		$consulta_usuario="SELECT * FROM USUARIOS WHERE CodUsuario='".$_GET['user']."'";
		$resultado_usuario=mysqli_query($conexion,$consulta_usuario);
		if(!$resultado_usuario){
			echo "<h2>error al buscar datos del usuario</h2>";
			exit();
		}else{
			$ver_usuario=mysqli_fetch_array($resultado_usuario);
			$dir_subida='../Img_Usuarios/';
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
                 background:rgb(46, 74, 117);
}
		form{
			width: 600px;
			margin: 0px auto;
                        font-family:Arial;
                        color:white;
		}
		fieldset{
			padding: 80px;
			margin: 50px 0px;
                        background:#e7a61a;
                        border-radius:5px;

		}
		span{
			display: inline-block;
			width: 200px;
		}

		input{
			display: inline-block;
			margin: 5px;
                        border-radius:5px;
		}
		#botones{
			width: 200px;
			padding: 5px;
			margin: 0px auto;
		}
	</style>
</head>
<body>

<?php if (!isset($_FILES['avatar'])): ?>
		<form method='post' enctype='multipart/form-data'>
				<fieldset>
					<center><h1>Editar Usuario</h1></center>
					<span>Usuario:</span><input type='text' name='usuario' value="<?php echo $ver_usuario['Usuario']; ?>">
					<span>Nombre:</span><input type='text' name='nombre' value="<?php echo $ver_usuario['Nombre']; ?>">
					<span>Apellidos:</span><input type='text' name='apellidos' value="<?php echo $ver_usuario['Apellidos']; ?>">
					<span>Fecha de Nacimiento:</span><input type='date' name='fecha' value="<?php echo $ver_usuario['FechaNacimiento']; ?>">
					<span>Correo Eletronico:</span><input type='email' name='correo' value="<?php echo $ver_usuario['CorreoElectronico']; ?>">
					<span>Constraseña:</span><input type='password' name='contra' value="<?php echo $ver_usuario[9]; ?>">
					<span>Avatar:</span><input type="file" accept="image/*" name="avatar"><br>
					<center>
					<img style="width:50px; height:50px;" src="../Img_Usuarios/<?php echo $ver_usuario['ImgUsuario']; ?>">
					<br></br>
					<input type='submit' name='enviar' value='Guardar Cambios'>
					</center>
				</fieldset>
		</form>
 <?php else: ?>
 	<?php 
 		$contra=md5($_POST['contra']);

 		$actualizar_usuario="UPDATE USUARIOS SET Nombre='".$_POST['nombre']."' WHERE CodUsuario='".$_GET['user']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET Apellidos='".$_POST['apellidos']."' WHERE CodUsuario='".$_GET['user']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET Usuario='".$_POST['usuario']."' WHERE CodUsuario='".$_GET['user']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET FechaNacimiento='".$_POST['fecha']."' WHERE CodUsuario='".$_GET['user']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET CorreoElectronico='".$_POST['correo']."' WHERE CodUsuario='".$_GET['user']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET Constraseña='".$_POST['contra']."' WHERE CodUsuario='".$_GET['user']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);


 		if ($_FILES['avatar']['name']!="" AND !FILE_EXISTS("../Img_Usuarios/".$_FILES['avatar']['name'])) {
 			if($ver_usuario['ImgUsuario']!='sinimagen.png'){
 				$eliminar="../Img_Usuarios/".$ver_usuario['ImgUsuario'];
				unlink($eliminar);
 			}
 			
 			$fichero_subido=$dir_subida.basename($_FILES['avatar']['name']);
			if(move_uploaded_file($_FILES['avatar']['tmp_name'], $fichero_subido)){
 				$actualizar="UPDATE USUARIOS SET ImgUsuario='".$_FILES['avatar']['name']."' WHERE CodUsuario='".$_GET['user']."'";
 				if(!$resultado_actualizar=mysqli_query($conexion,$actualizar)){
 				echo "error al subir la imagen";
 				}
 			
			}else{
				 echo "error al mover imagen";
			}

				

 		}
echo "<script type='text/javascript'>
				alert('¡usuario modificado!');
				var pagina='usuarios.php?opcion=USUARIOS?user=kuiki';
				function redireccionar(){
				location.href=pagina;
				} 
				setTimeout ('redireccionar()', 500);
			</script>";	 	
 		mysqli_close($conexion);

 	 ?>
	
<?php endif ?>
</body>
</html>