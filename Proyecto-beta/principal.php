<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Blog Personal</title>
	<script src="jquery-3.1.1.js" type="text/javascript"></script>  
	<link rel="stylesheet" type="text/css" href="blog_css.css"> 
	<style type="text/css">
		div{
			margin: 0px auto;
		}
	</style>

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
				<img src="logo.png">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">
			<?php if(!empty($_POST['user'])): ?>

				<div id="user">
				<center>
				<?php 

					$consulta="SELECT * FROM USUARIOS WHERE Usuario='".$_POST['user']."';";
					$resultado=mysqli_query($conexion,$consulta);
					mysqli_close($conexion);
					$fila=mysqli_fetch_array($resultado);
					if(!is_null($fila)){
						if($fila['Usuario']==$_POST['user'] && $fila['Contraseña']==md5($_POST['pass'])){
							$_SESSION['Usuario']=$_POST['user'];
							echo "<img id='avatar' src='user.png'><br>";
							echo "<a href='panel1.php?user=".$fila['Usuario']."'>".$_POST['user']."</a>";
							echo "<br>";
							echo "<a href='principal.php' style='font-size:10px'>[Cerrar Sesión]</a>";
							echo "<script type='text/javascript'>alert('Bienvenido!!!');</script>";
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
				 </div>
			<?php else: ?>
				<form method="post">
					<span>Usuario:</span>
        			<input type="text" name="user" required>
        			<br>
    				<span>Contraseña:</span>
    				<input type="password" name="pass" required>
    				<br>
    				<a style="font-size:13px; margin-left: 70px;" href="http://localhost/Proyecto_IAW/Proyecto-beta/registro.php">Registrate</a>
    				<input type="submit" name="sesion" value="Iniciar Sesión">
				</form>
			<?php endif ?>
				
			</div>
		</div>
		<div id="categorias">
			<ul>
				<a href="principal.php?categoria=windows"><li>Windows</li></a>
				<a href="principal.php?categoria=linux"><li>GNU/Linux</li></a>
				<a href="principal.php?categoria=raspberry"><li>Raspberry</li></a>
				<a href="principal.php?categoria=android"><li>Android</li></a>
				<a href="principal.php?categoria=pc"><li>PC'S</li></a>
			</ul>

		</div>
		<div id="entrada">
				<div></div>
				<div></div>
				<div></div>
		</div>
		<div id="pie"></div>
</body>
</html>