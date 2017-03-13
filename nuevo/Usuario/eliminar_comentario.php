<?php 
	include '../conexion.php';
	if (isset($_SESSION['Usuario'])) {
		$eliminar_consulta="DELETE FROM COMENTARIOS WHERE IdComentario=".$_GET['id'];
		if($eliminar_comentario=mysqli_query($conexion,$eliminar_consulta)){
                        if(isset($_GET['entrada'])){
			echo "<script type=text/javascript>
						alert('Comentario eliminado');
						var pagina='comentarios.php?entrada=".$_GET['entrada']."';
						function redireccionar(){
						location.href=pagina;
						} 
					setTimeout ('redireccionar()', 500);	
				 </script>";
                        }else{
                        echo "<script type=text/javascript>
						alert('Comentario eliminado');
						var pagina='comentarios.php';
						function redireccionar(){
						location.href=pagina;
						} 
					setTimeout ('redireccionar()', 500);	
				 </script>";
                          }
		}else{
			echo "Error al eliminar";
		}

	}

 ?>