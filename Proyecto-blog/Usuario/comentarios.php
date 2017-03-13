<?php 
	include '../conexion.php';
 ?>
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
					echo "<option value='COMENTARIOS' selected>Mis Comentarios</option>";
				if($_SESSION['Usuario']=='kuiki'){
					echo "<option value='USUARIOS'>Usuarios</option>";
				}					
				echo "<option value='PERFIL'>Mi Perfil</option>";
				echo "</select>";
				echo "<input type='submit' name='elegir' value='ir'>";
			echo "</form>";
		 ?>
 	<h1>Comentarios</h1>

		 <?php 
		 	if(isset($_GET['entrada'])){
		 		$consulta_usuarios="SELECT e.ImagenEntrada,e.IdEntrada,e.Titulo,c.Comentario,c.IdComentario FROM ENTRADAS e JOIN COMENTARIOS c ON e.IdEntrada=c.IdEntrada WHERE e.IdEntrada='".$_GET['entrada']."'";

		 	}else{
		 		$consulta_usuarios="SELECT e.ImagenEntrada,e.IdEntrada,e.Titulo,c.Comentario,c.IdComentario FROM ENTRADAS e JOIN COMENTARIOS c ON e.IdEntrada=c.IdEntrada WHERE e.CodUsuario='".$_SESSION['CodUsuario']."'";
		 	}
		 	
		 	$ver_consulta=mysqli_query($conexion,$consulta_usuarios);
		 	if(!$ver_consulta){
		 		echo "<h2>error en la consulta</h2>";
		 		exit();
		 	}else{
		 		if(mysqli_num_rows($ver_consulta)==0){
		 			echo "<h2>No tienes comentarios";
		 		}else{
echo "<table>
		 	<tr>

		 		<th>Imagen</th>
		 		<th>Titulo</th>
		 		<th>Comentario</th>
		 		<th>Eliminar</th>
		 	</tr>";
}

		 	}

		 ?>

		 
		 	<?php 
		 		while ($fila=mysqli_fetch_array($ver_consulta)) {
		 			echo "<tr><td>";
		 			echo "<img style='width:50px; height:50px;' src='../Img_Entradas/".$fila['ImagenEntrada']."'></td><td>";
		 			echo "<a href='../enviar_entrada.php?titulo=".$fila['Titulo']."&&id=".$fila['IdEntrada']."'>".$fila['Titulo']."</a</td><td>";
		 			echo "<p>".$fila['Comentario']."</p></td><td>";
		 			if (isset($_GET['entrada'])){
                                              echo "<a href='eliminar_comentario.php?id=".$fila['IdComentario']."&&entrada=".$_GET['entrada']."'>eliminar</a>
		 				  </td></tr>";
                                           }else{
                                             echo "<a href='eliminar_comentario.php?id=".$fila['IdComentario']."'>eliminar</a>
		 				  </td></tr>";
                                         }
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