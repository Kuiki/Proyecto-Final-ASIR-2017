
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="pic" accept="image/*">
  <input type="submit">
</form>
<?php
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.

$dir_subida='/var/www/html/Proyecto_IAW/Proyecto-beta/Prueba/';
$fichero_subido=$dir_subida.basename($_FILES['pic']['name']);

echo '<pre>';
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


?>

</body>
</html>
