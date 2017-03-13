<?php include '../conexion.php'; ?>
<?php if (!isset($_SESSION['Usuario'])): ?>
	<script type="text/javascript">
		alert("Lo siento no puede entrar. Redireccionando....");
		var pagina='../index.php';
		function redireccionar(){
		location.href=pagina;
		} 
		setTimeout ('redireccionar()', 500);
	</script>
<?php else: ?>
	<?php 
		$consulta="DELETE FROM ENTRADAS WHERE IdEntrada='".$_GET['id']."'";
		$resultado=mysqli_query($conexion,$consulta);
		if($resultado){
			echo "<script type='text/javascript'>
					alert('¡¡¡Entrada Eliminada!!!. Redireccionando....');
					var pagina='entradas.php?user=".$_SESSION['Usuario']."';
					function redireccionar(){
					location.href=pagina;
					} 
					setTimeout ('redireccionar()', 500);
			</script>";
		}else {
			echo "Hubo un problema al eliminar";
		}

	 ?>
	<script type="text/javascript"></script>
	
<?php endif ?>