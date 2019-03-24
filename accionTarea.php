<?php 

	include('database.php');

	if (isset($_POST['id']) & isset($_POST['option'])) {
		
		$id = $_POST['id'];
		$option = $_POST['option'];

		switch ($option) {
			case 1:
				$query = "SELECT * FROM tareas WHERE id = $id";

				$result = mysqli_query($conex,$query);
				if (!$result) {
					die('Ha fallado el query');
				}else{
					
					$item = mysqli_fetch_array($result);

					$json = array(
						'nombre' => $item['nombre'],
						'descripcion' => $item['descripcion'],
						'id' => $item['id']
					);

					$jsonDatos = json_encode($json);
					echo $jsonDatos;
				}
				break;

			case 2:
				$query = "DELETE FROM tareas WHERE id = $id";

				$result = mysqli_query($conex,$query);
				if (!$result) {
					die('Ha fallado el query');
				}else{
					echo "Se ha eliminado correctamente";
				}
				break;
			
			default:
				
				break;
		}

		
	}

?>