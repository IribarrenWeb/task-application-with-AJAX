<?php 

	include('database.php');

	$search = $_POST['search'];

	if (!empty($search)) {
		$query = "SELECT * FROM tareas WHERE nombre LIKE '%$search%'";
		$result = mysqli_query($conex,$query);

		if (!$result) {
			die('Error en el query ' . mysqli_error($conex));
		}
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			$json[] = array(
				'nombre' => $row['nombre'],
				'descripcion' => $row['descripcion'],
				'id' => $row['id']
			);
		}
		$resultJson = json_encode($json);
		echo $resultJson;
	}

?>