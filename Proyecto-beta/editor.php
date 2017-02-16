<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="blog_css.css"> 
	<style>
		#txtbox, #text {
		width: 86%;
		height:430px;
		padding:20px 50px;
		overflow:auto;
		background:#EFEFEF;
		border:0px none;
		margin: 5px;	
	}
	
	#text {
		display:none;
	}

	#editor button, input, select {
		background:#EFEFEF;
		border:#000000 none solid;
		margin: 1px;
	}

	div{
		float: left;
	}

	#editor {
		width: 815px;
		margin-top: 10px;
	}

	#enviar {
		background: #5f5f5f;
		width: 180px;
		height: 500px;
		margin-top: 135px;
		color:white;
	}

	#titulo{
		width: 600px;
		font: bold 30px Arial;
		margin:0px 5px;
		position: relative;
		bottom: 0px;
	}
	#menu {
		background: #5f5f5f;
		width: 800px;
		position: relative;
		top:5px;
		left: 5px;
	}

	#nueva entra{
		position: relative;
		top: 10px;
		left: 5px;
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
	<div id="padre" style=" width: 1000px;margin:0 auto;">
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
						echo "<a id='usuario' href='panel1.php?user=".$_GET['user']."'>".$_GET['user']."</a>";
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

	<div id="editor";">
		<h1>Nueva Entrada</h1>
<form method="post">
		<input id="titulo" type="text" name="titulo" value=""><br>
		<div id="menu">
		<center>
		<button onclick="init('bold')"><b>N</b></button>
		<button onclick="init('italic')"><i>I</i></button>
		<button onclick="init('underline')"><u>U</u></button>
		<button onclick="init('justifycenter')">Centrado</button>
		<button onclick="init('justifyfull')">Ordenado</button>
		<button onclick="init('justifyleft')">Izquierda</button>
		<button onclick="init('justifyright')">Derecha</button>
		<button onclick="init('increasefontsize')">Fuente +</button>
		<button onclick="init('inserthorizontalrule')">Línea Hr.</button>
		<button onclick="init('redo')">Rehacer</button>
		<button onclick="init('undo')">Deshacer</button>
		<button onclick="init('s')">Real</button>
		<button onclick="init('h')">HTML</button>
		</center>
		</div>
		<div id="txtbox" contenteditable="true">
		<h2>Título</h2>
		<p>Escribe aquí ...</p>
		<p>Etc ...</p>
		</div>
		<form method="post">
		<textarea id="text" name="text"></textarea>
	</div>
	<div id="enviar">
		<br>
		<center>
			<input type="submit" name="guardar" value="Guardar" onclick="init('h')">
			<input type="submit" name="publicar" value="Publicar" onclick="init('h')">			
			<br></br>
			<span>------ Categorias ------</span>
		</center>
		<ul style="list-style: none;">
			<li><input type="radio" name="categoria" value="linux">Linux</li>
			<li><input type="radio" name="categoria" value="windows">Windows</li>
			<li><input type="radio" name="categoria" value="raspberry">Raspberry</li>
			<li><input type="radio" name="categoria" value="pc">PC's</li>
		</ul>
	</div>
</form>
</div>
	<?php else: ?>

		<?php 
			$conexion=mysqli_connect("localhost","root","jallmay1995","blog");
			$id=substr($_GET['user'],0, 4);
			$entrada=rand(100,999);
			$IdEntrada=mb_strtoupper($id.$entrada);

			$consulta1="INSERT INTO ENTRADAS (IdEntrada,Titulo,Contenido,Publicado,CodUsuario) VALUES ('".$IdEntrada."','".$_POST['titulo']."','".$_POST['text']."','N','MACA004')";

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

			if($insertarcategoria==true && insertarentrada==true){
				echo "Entrada creada";
			}else{
				echo "No se pudo crear la entrada";
			}

		 ?>
	<?php endif ?>

		
</body>
</html>