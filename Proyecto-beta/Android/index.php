<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog Personal</title>
	<link rel="stylesheet" type="text/css" href="../blog_css.css"> 
	<style type="text/css">
		div{
			margin: 0px auto;
		}

		.sintaxis{
			width:70%;
			height:50%; 
			font-family: Arial;
			text-align:justify; 
			margin:0px auto;
			margin-top: 180px;
			font-size:15px;
		}
	</style>
	<script type="text/javascript">
		function inicio(){
			location.href='../principal.php';
		}

	</script>

</head>
<body>
		<?php 
			$conexion=mysqli_connect("localhost","root","jallmay1995","blog");
			mysqli_set_charset($conexion,"utf8");
			if(mysqli_connect_errno()){
				echo "Error de CONEXION con la BBDD";
				exit();
			}
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
					echo "<img id='avatar' src='../user.png'><br>";
							echo "<a href='../entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
							echo "<br>";
							echo "<a href='../principal.php' style='font-size:10px'>[Cerrar Sesión]</a>";
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

							if ($fila['TipoUsuario']=='Administrador') {
								echo "<script type='text/javascript'>alert('Bienvenido ".$fila['TipoUsuario']."!!!');</script>";
							}else {
								echo "<script type='text/javascript'>alert('Bienvenido ".$fila['Usuario']."!!!');</script>";
							}

							echo "<img id='avatar' src='../user.png'><br>";
							echo "<a href='entradas.php?user=".$fila['Usuario']."'>".$_POST['user']."</a>";
							echo "<br>";
							echo "<a href='principal.php' style='font-size:10px'>[Cerrar Sesión]</a>";
						}else {
							echo "<script type='text/javascript'>alert('¡Usuario o Contraseña incorrecta!');
								var pagina='http://localhost/Proyecto_IAW/Proyecto-beta/principal.php'
								function redireccionar(){
								location.href=pagina;
							  } 
							  setTimeout ('redireccionar()', 200);
							</script>";
						}
					}else {
						echo "<script type='text/javascript'>alert('¡El usuario no existe!');
								var pagina='http://localhost/Proyecto_IAW/Proyecto-beta/principal.php'
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
    				<a style="font-size:13px; margin-left: 70px;" href="http://localhost/Proyecto_IAW/Proyecto-beta/registro.php">Registrate</a>
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
				$consulta_entradas="SELECT * FROM ENTRADAS E JOIN PERTENECE P ON E.IdEntrada=P.IdEntrada JOIN CATEGORIAS C ON C.CodCategoria=P.CodCategoria WHERE NombreCategoria='Android'";
				$resultado_entrada=mysqli_query($conexion,$consulta_entradas);
				if($resultado_entrada==false){
					echo "<script type=text/javascript>
							alert('Error al obtener entradas');
						</script>";
				}else{
					while($fila_entrada=mysqli_fetch_array($resultado_entrada)){

						echo "<div>";
						$stringDisplay = substr(strip_tags($fila_entrada['Contenido']), 0, 150);

						if (strlen(strip_tags($fila_entrada['Contenido'])) > 150){
        						$stringDisplay .= ' ...';
    						}
						echo "<p class='sintaxis'>".$stringDisplay."</p>";
						echo "</div>";
					}
				}
				mysqli_close($conexion);



			 ?>
		</div>
		<div id="pie"></div>
</body>
</html>