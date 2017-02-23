<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="blog_css.css"> 
	<style type="text/css">
		body {
			background: #EFEAEA;
		}
		div{
			margin: 0px auto;
		}

		table{
			border: 1px solid black;
			border-collapse: collapse;
			width: 100%
		}

		tr,th{
			border: 1px solid black;
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
			location.href='principal.php';
		}

	</script>
</head>
<body>
<?php 
	session_start();
	if(empty($_SESSION['Usuario']) || empty($_GET['user'])){
		echo "<h1>Lo siento, no puedes entrar ...</h1>";
		var_dump($_SESSION);
		session_destroy();

		exit();
	}
 ?>
<div id="cabeza">
			<div id="logo">
				<img src="logo.png" onclick="inicio()">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">

				<div id="user">
					<center>
					<img id="avatar" src='user.png'><br>
					<?php 
						echo "<a id='usuario' href='entradas.php?user=".$_GET['user']."'>".$_GET['user']."</a>";
					 ?>
					 <br>
					 <a style="font-size: 10px;" href="">[Cerrar Sesión]</a>

					</center>
				 </div>
				
			</div>
		</div>
		<div id="categorias">
			<ul>
				<a href="principal.php?categoria=Windows"><li>Windows</li></a>
				<a href="principal.php?categoria=Linux"><li>GNU/Linux</li></a>
				<a href="principal.php?categoria=Raspberry"><li>Raspberry</li></a>
				<a href="principal.php?categoria=Android"><li>Android</li></a>
				<a href="principal.php?categoria=PCs"><li>PC'S</li></a>
			</ul>
		</div>
		</div>
		<div id="entrada">
		<h1>Entradas</h1><span><?php echo "<a href='nueva_entrada.php?user=".$_GET['user']."'>[Añadir Nueva Entrada]</a>"; ?></span>
		

		<?php
			
			$conexion=mysqli_connect("localhost","root","jallmay1995","blog");
			$consulta1="SELECT count(*) from ENTRADAS e JOIN USUARIOS u on e.CodUsuario=u.CodUsuario where Usuario='".$_GET['user']."'";
			$resultado1=mysqli_query($conexion,$consulta1);
			$numero=mysqli_fetch_row($resultado1);
		?>



		<?php if ($numero[0]!=0): ?>
			<table>
			<tr id="1" style="background: #5f5f5f; color:white">
				<th>Titulo</th>
				<th>Categoria</th>
				<th>Ult.Modificación</th>
				<th colspan="2">Editar</th>
				<th>Comentarios</th>
			</tr>

			<?php 
				$consulta2="SELECT e.IdEntrada, e.Titulo, c.NombreCategoria, e.UltimaModificacion, count(Comentario) Comentarios FROM ENTRADAS e JOIN USUARIOS u ON u.CodUsuario=e.CodUsuario LEFT JOIN PERTENECE p ON e.IdEntrada=p.IdEntrada LEFT JOIN CATEGORIAS c ON p.CodCategoria=c.CodCategoria LEFT JOIN COMENTARIOS co ON e.IdEntrada=co.IdEntrada where u.Usuario='".$_GET['user']."' group by e.IdEntrada, e.Titulo,c.NombreCategoria,e.UltimaModificacion";

				$resultado2=mysqli_query($conexion,$consulta2);

				while ($fila=mysqli_fetch_array($resultado2)) {
					echo "<tr><td>";
					echo "<a href=''>".$fila['Titulo']."</a></td><td>";
					echo $fila['NombreCategoria']."</td><td>";
					echo $fila['UltimaModificacion']."</td><td>";
					echo "<a href='editar_entrada.php?id=".$fila['IdEntrada']."'>editar</a></td><td>";
					echo "<a href='borrar_entrada.php?id=".$fila['IdEntrada']."'>borrar</a></td><td>";
					echo "<a href=''>comentarios(".$fila['Comentarios'].")</a></td></tr>";

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