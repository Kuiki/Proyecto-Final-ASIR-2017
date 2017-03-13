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
	if(empty($_SESSION['Usuario']) || empty($_GET['user'])){
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
						echo "<a id='usuario' href='entradas.php?user=".$_SESSION['Usuario']."'>".$_SESSION['Usuario']."</a>";
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
					echo "<option value='PERFIL'>Mi Perfil</option>";
				echo "</select>";
				echo "<input type='submit' name='elegir' value='ir'>";
			echo "</form>";
		 ?>
		<h1>Entradas</h1><span><?php echo "<a style='color:rgb(46, 74, 117);' href='nueva_entrada.php?user=".$_GET['user']."'>[Añadir Nueva Entrada]</a>"; ?></span>

		<?php
			$consulta1="SELECT count(*) from ENTRADAS e JOIN USUARIOS u on e.CodUsuario=u.CodUsuario where Usuario='".$_GET['user']."'";
			$resultado1=mysqli_query($conexion,$consulta1);
			$numero=mysqli_fetch_row($resultado1);
		?>	

		<?php if ($numero[0]!=0): ?>
			<table>
			<tr id="1">
				<th>Imagen</th>
				<th>Titulo</th>
				<th>Categoria</th>
				<th>Ult.Modificación</th>
				<th>Publicado</th>
				<th colspan="2">Editar</th>
				<th>Comentarios</th>
			</tr>

			<?php 
				$consulta2="SELECT e.ImagenEntrada, e.IdEntrada, e.Titulo, c.NombreCategoria, e.UltimaModificacion,e.Publicado, count(Comentario) Comentarios FROM ENTRADAS e JOIN USUARIOS u ON u.CodUsuario=e.CodUsuario LEFT JOIN PERTENECE p ON e.IdEntrada=p.IdEntrada LEFT JOIN CATEGORIAS c ON p.CodCategoria=c.CodCategoria LEFT JOIN COMENTARIOS co ON e.IdEntrada=co.IdEntrada where u.Usuario='".$_GET['user']."' group by e.ImagenEntrada, e.IdEntrada, e.Titulo,c.NombreCategoria,e.UltimaModificacion,e.Publicado";
				$resultado2=mysqli_query($conexion,$consulta2);

				while ($fila=mysqli_fetch_array($resultado2)) {
					echo "<tr><td>";
					echo "<img style='width:50px; height:50px;margin-top:5px;' src='../Img_Entradas/".$fila['ImagenEntrada']."'></td><td>";
					echo "<a href='../enviar_entrada.php?titulo=".$fila['Titulo']."&&id=".$fila['IdEntrada']."'>".$fila['Titulo']."</a></td><td>";
					echo $fila['NombreCategoria']."</td><td>";
					echo $fila['UltimaModificacion']."</td><td>";
					echo $fila['Publicado']."</td><td>";
					echo "<a href='editar_entrada.php?user=".$_GET['user']."&id=".$fila['IdEntrada']."'>editar</a></td><td>";
					echo "<a href='borrar_entrada.php?id=".$fila['IdEntrada']."&&user=".$_GET['user']."'>borrar</a></td><td>";
					echo "<a href='../Usuario/comentarios.php?entrada=".$fila['IdEntrada']."'>comentarios(".$fila['Comentarios'].")</a></td></tr>";

				}

			 ?>
			
			</table>

		<?php else: ?>
			<h3>No tienes ningna entrada creada ...</h3>
		<?php endif ?>

		</div>
		<div id="pie"></div>

</body>
</html>