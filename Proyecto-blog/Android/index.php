<!DOCTYPE html>
<html>
<head>
	<title>Blog Personal</title>
	<link rel="stylesheet" type="text/css" href="../blog_css.css"> 
	<style type="text/css">
		div{
			margin: 0px auto;
		}


	</style>
	<script type="text/javascript">
		function inicio(){
			location.href='../index.php';
		}

	</script>

</head>
<body>
		<?php 
			include '../conexion.php';
		?>
 		<div id="cabeza">
			<div id="logo">
				<img src="../logo.png" onclick="inicio()">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">
			<div id="user">
			<?php if (!empty($_SESSION)): ?>
				<center>
				<?php 
					echo "<img id='avatar' src='../Img_Usuarios/".$_SESSION['ImgUsuario']."'><br>";
							echo "<a href='../Entrada/entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
							echo "<br>";
							echo "<a href='../cerrar_session.php' style='font-size:10px'>[Cerrar Sesión]</a>";
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

							echo "<img id='avatar' src='../Img_Usuarios/".$_SESSION['ImgUsuario']."'><br>";
							echo "<a href='../Entrada/entradas.php?user=".$fila['Usuario']."'>".$_POST['user']."</a>";
							echo "<br>";
							echo "<a href='../cerrar_session.php' style='font-size:10px'>[Cerrar Sesión]</a>";
						}else {
							echo "<script type='text/javascript'>alert('¡Usuario o Contraseña incorrecta!');
								var pagina='index.php';
								function redireccionar(){
								location.href=pagina;
							  } 
							  setTimeout ('redireccionar()', 200);
							</script>";
						}
					}else {
						echo "<script type='text/javascript'>alert('¡El usuario no existe!');
								var pagina='index.php';
								function redireccionar(){
								location.href=pagina;
							  } 
							  setTimeout ('redireccionar()', 200);
						</script>";
					}

				 ?>
				 </center>
			<?php else: ?>
				<form method="post">
					<span>Usuario:</span>
        			<input type="text" name="user" required>
        			<br>
    				<span>Contraseña:</span>
    				<input type="password" name="pass" required>
    				<br>
    				<a style="font-size:13px; margin-left: 70px;" href="../registro.php">Registrate</a>
    				<input style="width:auto" type="submit" name="sesion" value="Iniciar Sesión">
				</form>
			<?php endif ?>
				</div>
			</div>
		</div>
		<div id="categorias">
			<ul>
				<a href="../Windows/"><li>Windows</li></a>
				<a href="../Linux"><li>GNU/Linux</li></a>
				<a href="../Raspberry"><li>Raspberry</li></a>
				<a href="../Android"><li>Android</li></a>
				<a href="../PCs"><li>PC'S</li></a>
			</ul>

		</div>
		<div id="entrada">
			<?php 
				$consulta_entradas="SELECT * FROM ENTRADAS E JOIN PERTENECE P ON E.IdEntrada=P.IdEntrada JOIN CATEGORIAS C ON C.CodCategoria=P.CodCategoria WHERE NombreCategoria='ANDROID' AND Publicado='S'";
				$resultado_entrada=mysqli_query($conexion,$consulta_entradas);
				if($resultado_entrada==false){
					echo "<script type=text/javascript>
							alert('Error al obtener entradas');
						</script>";
				}else{
					while($fila_entrada=mysqli_fetch_array($resultado_entrada)){
						echo "<a href='../enviar_entrada.php?titulo=".$fila_entrada['Titulo']."&&id=".$fila_entrada['IdEntrada']."'><div id='enviar_entrada'>";
						$stringDisplay = substr(strip_tags($fila_entrada['Contenido']), 0, 100);
						if (strlen(strip_tags($fila_entrada['Contenido'])) > 100){
        						$stringDisplay .= ' ...';
    						}
    					echo "<img class='imgentrada' src='../Img_Entradas/".$fila_entrada['ImagenEntrada']."'><br>";
						echo "<p class='sintaxis'>".$stringDisplay."</p>";
						echo "</div></a>";
					
					}
				}
				mysqli_close($conexion);



			 ?>
		</div>
		<div id="pie"></div>
</body>
</html>