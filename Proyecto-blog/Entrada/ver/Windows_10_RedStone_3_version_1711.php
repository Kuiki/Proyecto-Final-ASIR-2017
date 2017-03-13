<!DOCTYPE html>
<html>
<head>
	<title>Blog Personal</title>
	<link rel="stylesheet" type="text/css" href="../../blog_css.css"> 
	<style type="text/css">
		div{
			margin: 0px auto;
		}

		#contenedor_entrada{
			width: 90%;
			padding: 10px
			margin:0px;	
			text-align: justify;
		}

		#contenedor_entrada img{
			width: 650px;
			height: 380px;
		}

		#comentarios{
			width: 93%;
			margin: 0px auto;
			padding: 10px 40px;
		}
		#comentarios .contenedor_comentario	{
			width: 100%;
			margin: 0px;
			min-height: 100px;
		}

		#comentarios .contenedor_comentario>div{

			width: 8%;
			min-height: 100%;
			margin-top: 0px;
			float: left;
		}


		#comentarios .contenedor_comentario>div>center>img{
			width: 50px;
			height: 50px;
			margin-top:-5px;
		}



		#comentarios .contenedor_comentario .comentario{
			margin: 0px 5px;
			width: 85%;
			height: 80%;
			border-radius: 20px;
			padding: 20px;
			background: #5f5f5f;


		}

		#comentarios form textarea{
			width: 99%;
			max-width: 99%;
			max-height: 150px;
			font-size: 18px;
			height: 150px;

		}

		#comentarios form input{
			width: 100px;
			height: 40px;
			border-radius: 3px;
		}
	</style>
	<script type="text/javascript">
		function inicio(){
			location.href='../../index.php';
		}

	</script>

</head>
<body>
		<?php 
			include '../../conexion.php';
		?>
 		<div id="cabeza">
			<div id="logo">
				<img src="../../logo.png" onclick="inicio()">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">
			<div id="user">
			<?php if (!empty($_SESSION)): ?>
				<center>
				<?php 
					echo "<img id='avatar' src='../../Img_Usuarios/".$_SESSION['ImgUsuario']."'><br>";
							echo "<a href='../entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
							echo "<br>";
							echo "<a href='../../cerrar_session.php' style='font-size:10px'>[Cerrar Sesión]</a>";
				 ?>
			<?php elseif(!empty($_POST['user'])): ?>
				<center>
				<?php 
					$consulta="SELECT * FROM USUARIOS WHERE Usuario='".$_POST['user']."';";
					$resultado=mysqli_query($conexion,$consulta);
					$fila=mysqli_fetch_array($resultado);
					if(!is_null($fila)){
						if($fila['Usuario']==$_POST['user'] && $fila['Contraseña']==md5($_POST['pass'])){
							$_SESSION['Usuario']=$_POST['user'];
							$_SESSION['CodUsuario']=$fila['CodUsuario'];
                                                        $_SESSION['ImgUsuario']=$fila['ImgUsuario'];

							if ($fila['TipoUsuario']=='Administrador') {
								echo "<script type='text/javascript'>alert('Bienvenido ".$fila['TipoUsuario']."!!!');</script>";
							}else {
								echo "<script type='text/javascript'>alert('Bienvenido ".$fila['Usuario']."!!!');</script>";
							}

							echo "<img id='avatar' src='../../".$_SESSION['ImgUsuario']."'><br>";
							echo "<a href='../entradas.php?user=".$fila['Usuario']."'>".$_POST['user']."</a>";
							echo "<br>";
							echo "<a href='../../index.php' style='font-size:10px'>[Cerrar Sesión]</a>";
						}else {
							echo "<script type='text/javascript'>alert('¡Usuario o Contraseña incorrecta!');
								var pagina='../../index.php';
								function redireccionar(){
								location.href=pagina;
							  } 
							  setTimeout ('redireccionar()', 200);
							</script>";
						}
					}else {
						echo "<script type='text/javascript'>alert('¡El usuario no existe!');
								var pagina='../../index.php';
								function redireccionar(){
								location.href=pagina;
							  } 
							  setTimeout ('redireccionar()', 200);
						</script>";
					}

				 ?>
				 </center>
￼
￼
			<?php else: ?>
				<form method="post">
					<span>Usuario:</span>
        			<input type="text" name="user" required>
        			<br>
    				<span>Contraseña:</span>
    				<input type="password" name="pass" required>
    				<br>
    				<a style="font-size:13px; margin-left: 70px;" href="../../registro.php">Registrate</a>
    				<input style="width:auto" type="submit" name="sesion" value="Iniciar Sesión">
				</form>
			<?php endif ?>
				</div>
			</div>
		</div>
		<div id="categorias">
			<ul>
				<a href="../../Windows/"><li>Windows</li></a>
				<a href="../../Linux"><li>GNU/Linux</li></a>
				<a href="../../Raspberry"><li>Raspberry</li></a>
				<a href="../../Android"><li>Android</li></a>
				<a href="../../PCs"><li>PC'S</li></a>
			</ul>

		</div>
		<div id="entrada">
			<div id="contenedor_entrada">
			<?php 
				$consulta_entrada="SELECT * FROM ENTRADAS WHERE IdEntrada='".$_GET['id']."'";
				if($resultado_entrada=mysqli_query($conexion,$consulta_entrada)){
					$ver_entrada=mysqli_fetch_array($resultado_entrada);
					echo "<center><h1><u>".utf8_decode($ver_entrada['Titulo'])."</u></h1>";
					echo "<img src='../../Img_Entradas/".$ver_entrada['ImagenEntrada']."'></center>";
					echo $ver_entrada['Contenido'];
				}else{
					echo "error en la consulta";
				}

			?>
			</div>

			<div id="comentarios">
			<?php 
				$consulta_comentarios="SELECT u.Usuario,u.ImgUsuario, c.* FROM USUARIOS u JOIN COMENTARIOS c ON u.CodUsuario=c.CodUsuario WHERE c.IdEntrada='".$_GET['id']."'";

				$resultado_comentarios=mysqli_query($conexion,$consulta_comentarios);
			?>
				<h2><u>Comentarios</u> (<?php echo mysqli_num_rows($resultado_comentarios);?>)</h3>

				<?php 
				while($ver_comentarios=mysqli_fetch_array($resultado_comentarios)){
						echo "<div class='contenedor_comentario'>";
						echo "<div><center><img src='../../Img_Usuarios/".$ver_comentarios['ImgUsuario']."'><br>";
						echo "<span>[".$ver_comentarios['Usuario']."]</span></center></div>";
						echo "<div class='comentario'><b><i>".$ver_comentarios['Comentario']."</i></b></div>";
						echo "</div><br>";
					}

					echo "<span><b>¿Quieres responder?</b></span>";
					echo "<form method='post'>";
					echo "<textarea name='comentario'></textarea><br>";
					echo "<input type='submit' name='comentar' value='RESPONDER'>";
					echo "</form>";

					if(isset($_POST['comentar'])){
						if(!isset($_SESSION['Usuario'])){
							echo "<script type='text/javascript'>
										var pagina='../../session.php';
										function redireccionar(){
										location.href=pagina;
										} 
										setTimeout ('redireccionar()', 200);
									  </script>";						
									}else{
							$comentario_consulta="INSERT INTO COMENTARIOS (CodUsuario,IdEntrada,Comentario) VALUES('".$_SESSION['CodUsuario']."','".$_GET['id']."','".$_POST['comentario']."')";
							$insertar_comentario=mysqli_query($conexion,$comentario_consulta);
							if(!$insertar_comentario){
								echo "lo siento hubo un error al comentar";
								echo $comentario_consulta;
							}else{
								$buscar_archivo=scandir("Entrada/",1);
								$archivo_actual_entrada=$buscar_archivo[0];
								echo "<script type='text/javascript'>
										alert('Comentario agregado');
										var pagina='".$archivo_actual_entrada."?id=".$_GET['id']."';
										function redireccionar(){
										location.href=pagina;
										} 
										setTimeout ('redireccionar()', 200);
									  </script>";
							}
						}	
					}
					mysqli_close($conexion);
			 ?>
				


			</div>
			
		</div>
		<div id="pie"></div>
</body>
</html>