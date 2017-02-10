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
</head>
<body>
<div id="cabeza">
			<div id="logo">
				<img src="logo.png">
				<h1>Tuto Informático</h1>
			</div>
			<div id="login">

				<div id="user">
					<img id="avatar" src='user.png'><br>
					<?php 
						echo "<a id='usuario' href='panel1.php?user=".$_GET['user']."'>".$_GET['user']."</a>";
					 ?>
					 <br>
					 <a style="font-size: 10px;" href="">[Cerrar Sesión]</a>

				 </span>
				 </div>
				
			</div>
		</div>
		<div id="categorias">
			<ul>
				<a href=""><li>Windows</li></a>
				<a href=""><li>GNU/Linux</li></a>
				<a href=""><li>Raspberry</li></a>
				<a href=""><li>Android</li></a>
				<a href=""><li>PC'S</li></a>
			</ul>

		</div>
		<div id="entrada">
		<h1>Entradas</h1>

		<?php  
		
			$conexion=mysqli_connect("localhost","root","jallmay1995","blog");
			$consulta="SELECT E.* FROM ENTRADAS E JOIN USUARIOS U ON E.CodUsuario=U.CodUsuario WHERE U.Alias='".$_GET['user']."'";
			$resultado=mysqli_query($conexion,$consulta);
			$numero=mysqli_num_rows($resultado);
		?>

		<?php if ($numero!=0): ?>
			<table>
			<tr id="1" style="background: #5f5f5f; color:white">
				<th>Titulo</th>
				<th>Categoria</th>
				<th>Ult.Modificación</th>
				<th colspan="2">Editar</th>
				<th>Comentarios</th>
			</tr>
			<tr>
				<td><a href="">Instalar GNU/Linux desde cero</a></td>
				<td>Linux</td>
				<td>27/01/2016</td>
				<td><a href="">editar</a></td>
				<td><a href="">borrar</a></td>
				<td><a href="">comentarios</a></td>
			</tr>
			</table>
		<?php else: ?>
			<h3>No tienes ningna entrada creada ...</h3>
		<?php endif ?>

		</div>
		<div id="pie"></div>

</body>
</html>