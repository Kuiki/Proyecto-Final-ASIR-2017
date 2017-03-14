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
               
           if (x=="o") {
					
               document.getElementById('text').value=document.getElementById('txtbox').innerHTML;

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
		include '../conexion.php'
 	?>

 	<?php 
				$consulta_entrada="SELECT E.Titulo,E.Contenido,C.NombreCategoria,E.ImagenEntrada FROM ENTRADAS E JOIN PERTENECE P ON E.IdEntrada=P.IdEntrada JOIN CATEGORIAS C ON C.CodCategoria=P.CodCategoria WHERE E.IdEntrada='".$_GET['id']."'";
				$resultado=mysqli_query($conexion,$consulta_entrada);
				$fila=mysqli_fetch_array($resultado);
				$dir_subida='../Img_Entradas/';
				if($resultado==false){
					echo "error en la consulta";
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
					<img id="avatar" src='../Img_Usuarios/<?php echo $_SESSION['ImgUsuario']; ?>'><br>
					<?php 
						echo "<a id='usuario' href='entradas.php?user=".$_GET['user']."'>".$_GET['user']."</a>";
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
				<?php 
						echo "<input id='titulo' type='text' name='titulo' value='".$fila['Titulo']."' required>";
				?>
				<br>
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
					<?php 
						echo $fila['Contenido'];
					 ?>
				</div>
				<textarea id="text" name="text"></textarea>
			</div>
			<div id="enviar">
				<br>
				<center>
					<input type="submit" name="guardar" value="Guardar" onclick="init('o')">
					<input type="submit" name="guardar" value="Publicar" onclick="init('o')">			
					<br></br>
					<span><b>Categorias</b></span>
				</center>
				<ul style="list-style: none;">
					<?php 
						$linux="value='GNU/Linux'";
						$windows="value='Windows'";
						$android="value='Android'";
						$raspberry="value='Raspberry'";
						$pcs="value='PCs'";

						if ($fila['NombreCategoria']=="GNU/Linux"){
							$linux=$linux." checked='checked'";
						}elseif ($fila['NombreCategoria']=="Windows") {
							$windows=$windows." checked='checked'";
						}elseif ($fila['NombreCategoria']=="Android") {
							$android=$android." checked='checked'";
						}elseif ($fila['NombreCategoria']=="Raspberry") {
							$raspberry=$raspberry." checked='checked'";
						}elseif ($fila['NombreCategoria']=="PCs") {
							$pcs=$pcs." checked='checked'";
						}
					 ?>
					<li><input type="radio" name="categoria" <?php echo $linux; ?>>Linux</li><br>
					<li><input type="radio" name="categoria" <?php echo $windows; ?>>Windows</li><br>
					<li><input type="radio" name="categoria" <?php echo $android; ?>>Android</li><br>
					<li><input type="radio" name="categoria" <?php echo $raspberry; ?>>Raspberry</li><br>
					<li><input type="radio" name="categoria" <?php echo $pcs; ?>>PC's</li>
				</ul>
				<br>
				<center>
					<span><b>Imágen de Portada</b></span><br></br>
					<input style="background: #5f5f5f; width: 200px;" type="file" accept="image/*" name="imgentrada">
					<br></br>
					<img style="width:100px; height:100px;" src="../Img_Entradas/<?php echo $fila['ImagenEntrada']; ?>">
				</center>

			</div>
		</form>
	</div>
	<br></br>
	<div id="pie"><br></br><br><center><span>Administración de Sistemas Informaticos en Red (2ASIR).</span><br><span>Dirección: Calle San Jacinto, 79 - Sevilla.</span><br><span>Página realizada por Luigui Alvarez Ramirez.</span></center></div>
		
	<?php else: ?>
		<?php
			if($fila['Titulo']!=$_POST['titulo']){
				$actualizar_entrada="UPDATE ENTRADAS SET Titulo='".$_POST['titulo']."' WHERE IdEntrada='".$_GET['id']."'";
				
				$actulizar=mysqli_query($conexion,$actualizar_entrada);
			}

			if($fila['Contenido']!=$_POST['text']){
				$actualizar_entrada="UPDATE ENTRADAS SET Contenido='".$_POST['text']."' WHERE IdEntrada='".$_GET['id']."'";

				$actulizar=mysqli_query($conexion,$actualizar_entrada);

			}
			
			if($fila['NombreCategoria']!=$_POST['categoria']){
				$actualizar_categoria="UPDATE PERTENECE SET CodCategoria=(SELECT CodCategoria FROM CATEGORIAS WHERE NombreCategoria='".$_POST['categoria']."') WHERE IdEntrada='".$_GET['id']."'";
				
				$actulizar=mysqli_query($conexion,$actualizar_categoria);

			}

			if($_POST['guardar']=='Publicar'){
				$actualizar_categoria="UPDATE ENTRADAS SET Publicado='S' WHERE IdEntrada='".$_GET['id']."'";
				
				$actulizar=mysqli_query($conexion,$actualizar_categoria);

			}else{
				$actualizar_categoria="UPDATE ENTRADAS SET Publicado='N' WHERE IdEntrada='".$_GET['id']."'";
				
				$actulizar=mysqli_query($conexion,$actualizar_categoria);

			}

			if($fila['ImagenEntrada']!=$_FILES['imgentrada'] AND $_FILES['imgentrada']['name']!=""){			if($fila['ImagenEntrada']!='sinimagen.png'){
 					$eliminar="../Img_Entradas/".$fila['ImagenEntrada'];
					unlink($eliminar);
 				}
				$fichero_subido=$dir_subida.basename($_FILES['imgentrada']['name']);
				move_uploaded_file($_FILES['imgentrada']['tmp_name'], $fichero_subido);
				$actualizar_entrada="UPDATE ENTRADAS SET ImagenEntrada='".$_FILES['imgentrada']['name']."' WHERE IdEntrada='".$_GET['id']."'";

				$actulizar=mysqli_query($conexion,$actualizar_entrada);

			}

			echo "<script type='text/javascript'>
					alert('¡Entrada editada!');
					var pagina='entradas.php?user=".$_GET['user']."';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";
			mysqli_close($conexion);
		 ?>
	<?php endif ?>

</body>
</html>