<?php 
	include '../conexion.php';
	if(empty($_SESSION['Usuario'])){
		echo "<h1>Lo siento, no puedes entrar ...</h1>";
		session_destroy();
		exit();
	}else{
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

		h1{
			margin: 30px 50px;
		}
		form{
			margin: 0px 50px;
		}
		span{
			display: inline-block;
			font: bold 20px Arial;
			width: 180px;
			margin: 10px;
		}
		input{
			font: normal 18px Arial;
			display: inline-block;
			margin: 10px;

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
<div id="cabeza">
			<div id="logo">
				<img src="../logo.png" onclick="inicio()">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">

				<div id="user">
					<center>
					<img id="avatar" src='../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>'><br>
					<?php 
						echo "<a id='usuario' href='../Entrada/entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
					?>
					 <br>
					 <a style="font-size: 10px;" href="../..cerrar_session.php">[Cerrar Sesión]</a>

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
	<?php 
			echo "<form action='../opcion_usuario.php' method='post' style='margin:30px 10px;float:right;'>";
				echo "<select name='opcion'>";
					echo "<option value='ENTRADAS' selected>Mis entradas</option>";
					echo "<option value='COMENTARIOS'>Mis comentarios</option>";
				if($_SESSION['Usuario']=='kuiki'){
					echo "<option value='USUARIOS'>Usuarios</option>";
			}
					echo "<option value='PERFIL' selected>Mi Perfil</option>";
				echo "</select>";
				echo "<input type='submit' name='elegir' value='ir'>";
			echo "</form>";
		 ?>

	<h1>Mis Datos</h1>
	<form id="perfil" method='post' action="editar_perfil.php" enctype='multipart/form-data'>
					<span>Usuario:</span><input type='text' name='usuario' value="<?php echo $ver_usuario['Usuario']; ?>" readonly><br>
					<span>Nombre:</span><input type='text' name='nombre' value="<?php echo $ver_usuario['Nombre']; ?>" readonly><br>
					<span>Apellidos:</span><input type='text' name='apellidos' value="<?php echo $ver_usuario['Apellidos']; ?>" readonly><br>
					<span>Fecha de Nacimiento:</span><input type='date' name='fecha' value="<?php echo $ver_usuario['FechaNacimiento']; ?>" readonly><br><br>
					<span>Correo Eletronico:</span><input type='email' name='correo' value="<?php echo $ver_usuario['CorreoElectronico']; ?>" readonly><br>
					<span>Constraseña:</span><input type='password' name='contra' value="<?php echo $ver_usuario[9]; ?>" readonly><br>
					<span style="float: left;">Avatar:</span>
					<img style="width:100px; height:100px; float: left; margin: 10px;" src="../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>"><br></br><br></br><br></br><br></br>
					<input type='submit' name='enviar' value='Editar Perfíl'>
		</form>

		</div>
		<div id="pie"><br></br><br><center><span>Administración de Sistemas Informaticos en Red (2ASIR).</span><br><span>Dirección: Calle San Jacinto, 79 - Sevilla.</span><br><span>Página realizada por Luigui Alvarez Ramirez.</span></center></div>
</html>