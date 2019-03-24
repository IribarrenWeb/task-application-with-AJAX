<?php 

	include('database.php');

	if (isset($_POST['nombre'])) {
		
		$nombre = $_POST ['nombre'];
		$descripcion = $_POST ['descripcion'];
		$id = $_POST ['id'];

		$sql = "UPDATE tareas SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = '$id'";
		$result = mysqli_query($conex,$sql);

		if (!$result) {
			echo 'Ha fallado el query';
		}else{
			echo "Tarea editada";
		}
	}

?>