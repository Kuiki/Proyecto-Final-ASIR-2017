<!DOCTYPE html>
<html>
<head>
	<title>Tuto Informatico</title>
	<link rel="stylesheet" type="text/css" href="header.css">
	<link rel="stylesheet" type="text/css" href="body.css">
	<link rel="stylesheet" type="text/css" href="footer.css">

	<style type="text/css">
		#father{
			width: 100%;
			height: auto;
			margin: 0px auto;

			padding: 10px 0px;
			background: red;
		}
		#father div{
			border:1px solid black;
		}

		.container{
			width: 900px;
			height: 700px; 
			margin: 0px auto;
			padding: 0px;
		}

		
	</style>
</head>
<body>

	<div id="father">
		<div id="header" class="container">
			<div id="logo">
				<div>
					<img src="img/logo.png">
					<h1 style="font-family: monospace; font-size: 30px">TutoInformático</h1>

				</div>
				<div>
					<form>
						<label>Usuario: </label>
						<input type="text" name="user">

						<input class="session" type="submit" name="entrar" value="Entrar">

						<label>Contraseña: </label>
						<input type="password" name="pass">

						<input class="session" type="submit" name="registrarse" value="Registrarse">
						<br>
						<a href="">¿olvidaste la contraseña?</a>
					</form>	


				</div>
			</div>
			<div id="category">
				<div><a href=""><p>Categoría 1</p></a></div>
				<div><a href=""><p>Categoría 2</p></a></div>
				<div><a href=""><p>Categoría 3</p></a></div>
				<div><a href=""><p>Categoría 4</p></a></div>
				<div id="search">
					<form method="post">
						<img src="img/search.png">
						<input type="text" name="buscar" value="">
					</form>
				</div>
			</div>

		</div>
		<div id="body" class="container">
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
			<div class="entry"></div>
		</div>
		<div id="footer" class="container"></div>
	</div>
</body>
</html>