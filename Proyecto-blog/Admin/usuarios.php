<!DOCTYPE html>
 <html>
 <head>
 	<title></title>
	<link rel="stylesheet" type="text/css" href="../blog_css.css"> 
	<style type="text/css">
		div{
			margin: 0px auto;
		}

		table{
			border: 1px solid rgb(46, 74, 117);
			border-collapse: collapse;
			width: 90%;
                        margin:0px auto;
		}
                table #1{
style="background:rgb(46, 74, 117); 
color:white"
}

		tr,th{
			border: 1px solid rgb(46, 74, 117);
		}

		th{
			padding: 8px 10px;
		}

		td{
			text-align: center;
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
	if(empty($_SESSION['Usuario']) || $_SESSION['Usuario']!='kuiki'){
		echo "<h1>Lo siento, no puedes entrar ...</h1>";
		session_destroy();
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
				<center>
					<img id="avatar" src='../Img_Usuarios/<?php echo $_SESSION['ImgUsuario'] ?>'><br>
					<?php 
						echo "<a id='usuario' href='../Entrada/entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
					?>
					 <br>
					 <a style="font-size: 10px;" href="../cerrar_session.php">[Cerrar Sesión]</a>

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
	<div id="entrada">
		<?php if (!isset($_POST['opcion'])) : ?>
			<?php 
			echo "<form action='../opcion_usuario.php' method='post' style='margin:30px 10px;float:right;'>";
				echo "<select name='opcion'>";
					echo "<option value='ENTRADAS'>Mis entradas</option>";
					echo "<option value='COMENTARIOS'>Comentarios</option>";
					echo "<option value='USUARIOS' selected>Usuarios</option>";
					echo "<option value='PERFIL'>Mi Perfil</option>";
				echo "</select>";
				echo "<input type='submit' name='elegir' value='ir'>";
			echo "</form>";
		 ?>
 	
		 <?php 
		 	$consulta_usuarios="SELECT u.CodUsuario, u.Usuario, u.ImgUsuario, count(e.IdEntrada) from ENTRADAS e RIGHT JOIN USUARIOS u ON e.CodUsuario=u.CodUsuario WHERE u.TipoUsuario='Estandar' GROUP BY u.CodUsuario, u.Usuario, u.ImgUsuario";

		 	$ver_consulta=mysqli_query($conexion,$consulta_usuarios);
		 	if(!$ver_consulta){
		 		echo "<h2>error en la consulta</h2>";
		 		echo $consulta_usuarios;
		 	}

		 ?>
<h1>Usuarios</h1>
		 <a style="color:rgb(46, 74, 117);'" href="../registro.php">[Crear Nuevo Usuario]</a>
		 <table>
		 	<tr style="background: #5f5f5f; color:white">

		 		<th>Imagen</th>
		 		<th>Usuario</th>
		 		<th>Entradas</th>
		 		<th>Editar</th>
		 	</tr>
		 	<?php 
		 		while ($fila=mysqli_fetch_array($ver_consulta)) {
		 			echo "<tr><td>";
		 			echo "<img style='width:50px; height:50px;' src='../Img_Usuarios/".$fila['ImgUsuario']."'></td><td>";
		 			echo "<a href='../Entrada/entradas.php?user=".$fila['Usuario']."'>".$fila['Usuario']."</a</td><td>";
		 			echo "(".$fila['count(e.IdEntrada)'].") entradas creadas</td><td>";
		 			echo "<a href='borrar_usuario.php?user=".$fila['CodUsuario']."'>eliminar</a>
		 				  <a href='editar_usuario.php?user=".$fila['CodUsuario']."'>editar</a>
		 				  </td></tr>";
		 		}

		 	 ?>
		 </table>



		<?php else: ?>
			<?php 
			 header("Location: ../Entrada/entradas.php?user=kuiki"); 
			?>
		<?php endif ?>
		
	</div>
	<div id="pie"></div>	
 </body>
 </html>