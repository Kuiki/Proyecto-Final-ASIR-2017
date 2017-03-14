<?php 
	session_start();
	if(empty($_SESSION['Usuario'])){
		echo "<h1>Lo siento, no puedes entrar ...</h1>";
		session_destroy();
		exit();
	}else{
		$conexion=mysqli_connect("localhost","id1042747_blog","blog1234","id1042747_blog");
		$consulta_usuario="SELECT * FROM USUARIOS WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
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
	<link rel="stylesheet" type="text/css" href="../blog_css.css"> 

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
			width: 150px;
		}

		input{
			display: inline-block;
			margin: 5px;
			width: 250px;
		}

		body {
			background: #EFEAEA;
		}
		div{
			margin: 0px auto;
		}
	</style>
</head>
<body>

<?php if (!isset($_FILES['avatar'])): ?>
<div id="cabeza">
			<div id="logo">
				<img src="../logo.png" onclick="inicio()">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">

				<div id="user">
					<center>
					<img id="avatar" src='../Img_Usuarios/<?php echo $_SESSION['ImgUsuario'] ?>'><br>
					<?php 
						echo "<a id='usuario' href='../Entrada/entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
					?>
					 <br>
					 <a style="font-size: 10px;" href="">[Cerrar Sesión]</a>

					</center>
				 </div>
				
			</div>
		</div>
		<div id="categorias">
			<ul>
				<a href="../Windows"><li>Windows</li></a>
				<a href="../Linux"><li>GNU/Linux</li></a>
				<a href="../Raspberry"><li>Raspberry</li></a>
				<a href="../Android"><li>Android</li></a>
				<a href="../PCs"><li>PC'S</li></a>
			</ul>
		</div>
		</div>

		<div id="entrada">

		<form method='post' enctype='multipart/form-data'>
				<fieldset>
					<legend>Editar Usuario</legend>
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

 		$actualizar_usuario="UPDATE USUARIOS SET Nombre='".$_POST['nombre']."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET Apellidos='".$_POST['apellidos']."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET Usuario='".$_POST['usuario']."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";

 		$_SESSION['Usuario']=$_POST['usuario'];

 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET FechaNacimiento='".$_POST['fecha']."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET CorreoElectronico='".$_POST['correo']."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);

 		$actualizar_usuario="UPDATE USUARIOS SET Constraseña='".md5($_POST['contra'])."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
 		$resultado1=mysqli_query($conexion,$actualizar_usuario);


		if ($_FILES['avatar']['name']!="") {
 			if($ver_usuario['ImgUsuario']!='sinimagen.png'){
 				$eliminar="../Img_Usuarios/".$ver_usuario['ImgUsuario'];
				unlink($eliminar);
 			}
 			
 			$fichero_subido=$dir_subida.basename($_FILES['avatar']['name']);
			if(move_uploaded_file($_FILES['avatar']['tmp_name'], $fichero_subido)){
 				$actualizar="UPDATE USUARIOS SET ImgUsuario='".$_FILES['avatar']['name']."' WHERE CodUsuario='".$_SESSION['CodUsuario']."'";
 				$_SESSION['ImgUsuario']=$_FILES['avatar']['name'];
 				if(!$resultado_actualizar=mysqli_query($conexion,$actualizar)){
 				echo "error al subir la imagen";
 				}
 			
			}else{
				 echo "error al mover imagen";
			}

 		}

 		echo "<script type='text/javascript'>
				alert('¡usuario modificado!');
				var pagina='perfil.php';
				function redireccionar(){
				location.href=pagina;
				} 
				setTimeout ('redireccionar()', 500);
			</script>";			
 		

 	 ?>
<?php endif ?>
</div>
		<div id="pie"><br></br><br><center><span>Administración de Sistemas Informaticos en Red (2ASIR).</span><br><span>Dirección: Calle San Jacinto, 79 - Sevilla.</span><br><span>Página realizada por Luigui Alvarez Ramirez.</span></center></div>
</body>
</html>