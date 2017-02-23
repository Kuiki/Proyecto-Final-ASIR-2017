<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="blog_css.css">
	<style>
	*{
		font-family: Arial;
	}

	#cuerpo #txtbox, #text {
		width: 96.2%;
		height:435px;
		padding:2%;
		overflow:auto;
		background:#EFEFEF;
		border:0px none;
		margin:5px 0px;	
	}
	
	#cuerpo #text {
		display:none;
	}

	#cuerpo #editor button, input, select {
		background:#EFEFEF;
		border:#000000 none solid;
		margin: 1px;
	}

	#cuerpo div{
		float: left;
	}

	#cuerpo #editor {
		width: 80%;
		height: 100%;
		margin-top: 10px;
	}

	#cuerpo #enviar {
		background: #5f5f5f;
		width: 20%;
		height: 500px;
		margin-top: 135px;
		color:white;
	}

	#cuerpo #titulo{
		width: 800px;
		font: bold 30px Arial;
		margin:0px;
		position: relative;
		bottom: 0px;
	}

	#cuerpo #menu {
		background: #5f5f5f;
		width: 100%;
		position: relative;
		top:5px;
		left: 0px;
	}

	#nueva entra{
		position: relative;
		top: 10px;
		left: 5px;
	}

	#cabeza{
		margin: 0px auto;
	}

	#categorias{
		margin:0px auto;
	}

</style>
<script>
	function init(x) {
		if (x=="h") {
			document.getElementById('txtbox').style.display='none';
			document.getElementById('text').style.display='block';
		}

		if (x=="s") {
			document.getElementById('txtbox').style.display='block';
			document.getElementById('text').style.display='none';
		}

		document.getElementById('text').value=document.getElementById('txtbox').innerHTML;

		if (x!="h" || x!="s"){ 
			document.execCommand(x,false,null);
			document.getElementById('txtbox').focus();
		}
	}

</script>
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
		session_destroy();
		exit();
	}
 	?>
 	
	<?php if (!isset($_POST['guardar'])): ?>
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
				<a href="principal.php?categoria=windows"><li>Windows</li></a>
				<a href="principal.php?categoria=linux"><li>GNU/Linux</li></a>
				<a href="principal.php?categoria=raspberry"><li>Raspberry</li></a>
				<a href="principal.php?categoria=android"><li>Android</li></a>
				<a href="principal.php?categoria=pc"><li>PC'S</li></a>
			</ul>
	</div>
	<div id="cuerpo" style="margin: 0px auto;width: 1200px;height: 635px;">
		<form method="post">
			<div id="editor">
				<h1>Nueva Entrada</h1>
				<input id="titulo" type="text" name="titulo" value="" required><br>
				<div id="menu">
					<center>
						<input type="button" value="N" onclick="init('bold')"></input>
						<input type="button" value="I" onclick="init('italic')"></input>
						<input type="button" value="U" onclick="init('underline')"></input>
						<input type="button" value="Centrado" onclick="init('justifycenter')"></input>
						<input type="button" value="Ordenado" onclick="init('justifyfull')"></input>
						<input type="button" value="Izq" onclick="init('justifyleft')"></input>
						<input type="button" value="Der" onclick="init('justifyright')"></input>
						<input type="button" value="Fuente +" onclick="init('increasefontsize')"></input>
						<input type="button" value="Linea HR" onclick="init('inserthorizontalrule')"></input>
						<input type="button" value="Rehacer" onclick="init('redo')"></input>
						<input type="button" value="Deshacer" onclick="init('undo')"></input>
						<input type="button" value="Real" onclick="init('s')"></input>
						<input type="button" value="HTML" onclick="init('h')"></input>
					</center>
				</div>
				<div id="txtbox" contenteditable="true">
					<p>Escribe aquí ...
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
					</p>
				</div>
				<textarea id="text" name="text"></textarea>
			</div>
			<div id="enviar">
				<br>
				<center>
					<input type="submit" name="guardar" value="Guardar" onclick="init('h')">
					<input type="submit" name="publicar" value="Publicar" onclick="init('h')">			
					<br></br>
					<span><b>Categorias</b></span>
				</center>
				<ul style="list-style: none;">
					<li><input type="radio" name="categoria" value="GNU/Linux">Linux</li><br>
					<li><input type="radio" name="categoria" value="Windows">Windows</li><br>
					<li><input type="radio" name="categoria" value="Android">Android</li><br>
					<li><input type="radio" name="categoria" value="Raspberry">Raspberry</li><br>
					<li><input type="radio" name="categoria" value="PCs">PC's</li>
				</ul>
				<br>
				<center>
					<span><b>Imágen de Portada</b></span><br>
					

<?php
/*
<form method="post" enctype="multipart/form-data">
  <input type="file" name="pic" accept="image/*">
  <input type="submit">
</form>
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.

$dir_subida='/var/www/html/Proyecto_IAW/Proyecto-beta/Prueba/';
$fichero_subido=$dir_subida.basename($_FILES['pic']['name']);
echo '<pre>';
var_dump($_FILES);
if (move_uploaded_file($_FILES['pic']['tmp_name'], $fichero_subido)){
    echo "El fichero es válido y se subió con éxito.\n";
} else {
    echo "¡Posible ataque de subida de ficheros!\n";
}

echo 'Más información de depuración:';
var_dump($_FILES);
$imagen=$_FILES['pic']['name'];
print "</pre>";
echo "<img style='width:100px; height:100px;' src='Prueba/".$imagen."'>";

echo $_FILES['pic']['name'];
*/
?>
				</center>

			</div>
		</form>
	</div>

	<?php else: ?>
		<?php 
			$conexion=mysqli_connect("localhost","root","jallmay1995","blog");
			$id=substr($_GET['user'],0, 4);
			$entrada=rand(100,999);
			$IdEntrada=mb_strtoupper($id.$entrada);
			$consulta1="INSERT INTO ENTRADAS (IdEntrada,Titulo,Contenido,Publicado,CodUsuario) VALUES ('".$IdEntrada."','".$_POST['titulo']."','".$_POST['text']."','N','".$_SESSION['CodUsuario']."')";

			if(!empty($_POST['categoria'])){
				$codcategoria="SELECT CodCategoria FROM CATEGORIAS WHERE NombreCategoria LIKE '%".$_POST['categoria']."'";
				$resultcategoria=mysqli_query($conexion,$codcategoria);
				$fila=mysqli_fetch_row($resultcategoria);
				$consulta2="INSERT INTO PERTENECE (CodCategoria,IdEntrada) VALUES ('".$fila[0]."','".$IdEntrada."')";

			}else{
				$consulta2="INSERT INTO PERTENECE (CodCategoria,IdEntrada) VALUES('SIN000','".$IdEntrada."')";
			}
			

			$insertarentrada=mysqli_query($conexion,$consulta1);
			$insertarcategoria=mysqli_query($conexion,$consulta2);

			if($insertarcategoria==true && $insertarentrada==true){
					echo "<script type='text/javascript'>
					alert('¡Entrada creada!');
					var pagina='entradas.php?user=".$_GET['user']."';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";
			}else{
				echo "No se pudo crear la entrada";
			}

		 ?>
	<?php endif ?>
	<div id="pie" style="margin: 0px auto; width: 1200px;"></div>
		
</body>
</html>