<?php 

	include('database.php');

	$query = "SELECT * FROM tareas";
	$result = mysqli_query($conex,$query);

	if (!$result) {
		die('El query ha fallado');
	}
	
	$json = array();
	
	while ($row = mysqli_fetch_array($result)) {

		$json[] = array(
			'nombre' => $row['nombre'],
			'descripcion' => $row['descripcion'],
			'id' => $row['id']
		);
	}
	
	$jsonString = json_encode($json);
	echo $jsonString;
	
?>