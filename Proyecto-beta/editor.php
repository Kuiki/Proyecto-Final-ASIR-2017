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
		bottom: 40px;
	}
	#menu {
		background: #5f5f5f;
		width: 800px;
		position: relative;
		top:45px;
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
</head>
<body>
	<?php if (!isset($_POST['guardar'])): ?>
	<div id="padre" style=" width: 1000px;margin:0 auto;">
	<div id="cabeza">
		<div id="logo">
			<img src="logo.png">
			<h1>Tuto Informático</h1>
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

	<div id="editor";">
		<h1>Nueva Entrada</h1>
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
<form method="post">
		<input id="titulo" type="text" name="titulo" value=""><br>
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
			$id="";

			if(!empty($_POST['categoria'])){
				$id="SELECT CodCategoria FROM CATEGORIAS WHERE NombreCategoria='".$_POST['categoria']";
				$resul=mysqli_query($conexion,$id);


			}else{
				$categoria='Sin Categoria';
			}
			
			$consulta1="INSERT INTO ENTRADAS (IdEntrada,Titulo,Contenido,Publicado,Visitas,CodUsuario) VALUES ('ALPA001','".$_POST['titulo']."','".$_POST['text']."','N','MACA004')";

			$consulta2="INSERT INTO PERTENECE ('".$id."','".$categoria."'";

			var_dump($consulta1);
			echo "<br>";
			var_dump($consulta2);


		 ?>
	<?php endif ?>

		
</body>
</html>