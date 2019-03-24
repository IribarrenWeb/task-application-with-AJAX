$(document).ready(function(){

	$('#resulTareas').hide();
	getTareas();

	var editar = false;
	
	$('#search').keyup(function(){
		
		if ($('#search').val()) {

			var search = $('#search').val();
			
			$.ajax({
				url: 'buscador.php',
				type: 'POST',
				data: { search },
				success : function(response){
					let tarea = JSON.parse(response);
					let template = ''; 

					tarea.forEach( tarea =>{
						template += `<li>${tarea.nombre}</li>`
					});

					$('#resulTareas').show();
					$('#tareas').html(template);
				}
			});

		}else{
			$('#resulTareas').hide();
		}

	});

	$('#task').submit(function(hola){
		hola.preventDefault();
		const datosPost = {
			nombre: $('#nombre').val(),
			descripcion: $('#descripcion').val(),
			id: $('#id').val()
		};
		let url = '';
		
		if (editar === true) { url = 'editTarea.php' }else{ url = 'addTarea.php' }
		$.post(url,datosPost,function(response){
			getTareas();
			console.log(response)
			$('#task').trigger('reset');
		})

		editar = false;
		console.log(editar);
		
	});

	function getTareas(){

		$.ajax({
			url: 'selectTarea.php',
			type: 'GET',
			success: function(response){

				let tareas = JSON.parse(response);
				var plantilla = '';

				console.log(tareas)
				tareas.forEach( tarea => {
					plantilla +=`
						<tr value="${tarea.id}">
							<td>${tarea.id}</td>
							<td>${tarea.nombre}</td>
							<td>${tarea.descripcion}</td>
							<td>
								<button class="btn btn-sm btn-danger eliminar">
									Borrar
								</button>
							</td>
							<td>
								<button class="btn btn-sm btn-primary editar">
									Editar									
								</button>
							</td>
						</tr>
					`
				});

				$('#tareas1').html(plantilla);

			}
		})		

	}
// --------------------------------Botones de editar y eliminar----------------------------------------
	$(document).on('click', '.eliminar', function() {
		if (confirm('Desea eliminar esta tarea?')) {

			let elemento = $(this)[0].parentElement.parentElement
			let id = $(elemento).attr('value');
			let option = 2;
			$.post('accionTarea.php', { id, option }, function(response) {
				getTareas();
				console.log(response)
			});

		}
	});

	$(document).on('click', '.editar', function() {
			let elemento = $(this)[0].parentElement.parentElement
			let id = $(elemento).attr('value');
			let option = 1;
			$.post('accionTarea.php', { id, option }, function(response) {
				
				editar = true;
				console.log(response)
				let datos = JSON.parse(response);

				 $('#id').val(datos.id);
				 $('#nombre').val(datos.nombre);
				 $('#descripcion').val(datos.descripcion);

			});
	});

});