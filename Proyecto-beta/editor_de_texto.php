<!DOCTYPE html>
<html>
<head>
<title></title>
<style>
#txtbox, #text {
width:800px;
height:400px;
padding:20px 50px;
overflow:scroll;
background:#EFEFEF;
border:0px none;
}
#text {
display:none;
}
button, input, select {
background:#EFEFEF;
border:#000000 none solid;
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

<button onclick="init('bold')">Negrita</button>
<button onclick="init('italic')">Itálica</button>
<button onclick="init('insertimage')">Imagen</button>
<button onclick="init('underline')">Subrayado</button>
<button onclick="init('justifycenter')">Centrado</button>
<button onclick="init('justifyfull')">Ordenado</button>
<button onclick="init('justifyleft')">Izquierda</button>
<button onclick="init('justifyright')">Derecha</button>
<button onclick="init('increasefontsize')">Fuente +</button>
<button onclick="init('inserthorizontalrule')">Línea Hr.</button>
<button onclick="init('redo')">Rehacer</button>
<button onclick="init('undo')">Deshacer</button>
<button onclick="init('s')">Vista Real</button>
<button onclick="init('h')">Vista HTML</button>
<div id="txtbox" contenteditable="true">
<h2>Título</h2>
<p>Escribe aquí ...</p>
<p>Etc ...</p>
</div>
<form method="post">
<textarea id="text" name="text"></textarea>
<input type="submit" name="enviar" value="enviar">
</form>
	<?php 
		echo "hola mundo";
	?>
</body>
</html>
