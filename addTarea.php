<?php 

	include('database.php');

	if (isset($_POST['nombre'])) {
		
		$nombre = $_POST ['nombre'];
		$descripcion = $_POST ['descripcion'];

		$sql = "INSERT INTO tareas(nombre,descripcion) VALUES ('$nombre','$descripcion')";
		$result = mysqli_query($conex,$sql);

		if (!$result) {
			die('Ha fallado el query');
		}else{
			echo "Tarea agregada";
		}
	}

?>