<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../blog_css.css">
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
 	
	<?php if (!isset($_FILES['imgentrada'])) : ?>
	<div id="cabeza">
		<div id="logo">
			<img src="../logo.png" onclick="inicio()">
			<h1>Tuto Informático</h1>
		</div>
		<div id="login">
				<div id="user">
					<center>
					<img id="avatar" src='../Img_Usuarios/<?php echo $_SESSION['ImgUsuario'];?>'><br>
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
	<div id="cuerpo" style="margin: 0px auto;width: 1200px;height: 635px;">
		<form method="post" enctype="multipart/form-data">
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
					</p>
				</div>
				<textarea id="text" name="text"></textarea>
			</div>
			<div id="enviar">
				<br>
				<center>
					<input type="submit" name="guardar" value="Guardar" onclick="init('h')">
					<input type="submit" name="guardar" value="Publicar" onclick="init('h')">			
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
					<span><b>Imágen de Portada</b></span><br></br>
					<input style="background: #5f5f5f; width: 200px;" type="file" accept="image/*" name="imgentrada">
				</center>

			</div>
		</form>
	</div>
	<br></br>
	<div id="pie" style="margin: 0px auto; width: 1200px;"></div>
		
	<?php else: ?>
		<?php 
                        $codigo_usuario="SELECT CodUsuario FROM USUARIOS WHERE Usuario='".$_GET['user']."'";
                        $resultado_codigo=mysqli_query($conexion,$codigo_usuario);
                        $usuario=mysqli_fetch_array($resultado_codigo);
			$id=substr($_GET['user'],0, 4);
			$entrada=rand(100,999);
			$IdEntrada=mb_strtoupper($id.$entrada);
			$dir_subida='../Img_Entradas/';
			$publicar="N";

			if($_POST['guardar']=='Publicar'){
				$publicar="S";
			}

			if($_FILES['imgentrada']['name']!=""){
				$fichero_subido=$dir_subida.basename($_FILES['imgentrada']['name']);
				move_uploaded_file($_FILES['imgentrada']['tmp_name'], $fichero_subido);
				$consulta1="INSERT INTO ENTRADAS (IdEntrada,Titulo,ImagenEntrada,Contenido,Publicado,CodUsuario) VALUES ('".$IdEntrada."','".$_POST['titulo']."','".$_FILES['imgentrada']['name']."','".$_POST['text']."','".$publicar."','".$usuario['CodUsuario']."')";
			}else{
				$consulta1="INSERT INTO ENTRADAS (IdEntrada,Titulo,ImagenEntrada,Contenido,Publicado,CodUsuario) VALUES ('".$IdEntrada."','".$_POST['titulo']."','sinimagen.png','".$_POST['text']."','".$publicar."','".$usuario['CodUsuario']."')";
			}

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
					alert('¡Entrada creada!' );
					var pagina='entradas.php?user=".$_GET['user']."';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";

			}else{
				echo "No se pudo crear la entrada";
			}

			mysqli_close($conexion);
		 ?>
	<?php endif ?>

</body>
</html>