$(document).ready(function(){
	$(document).on('change', 'input[name=tipo]', function(event) {
		var tipo = $('input[name=tipo]:checked').val();
		$('.generos + label').hide();
		$('.generos_'+tipo+" + label").show();
	});

	$(document).on('submit', '#add_new_dj', function(event) {
		event.preventDefault();
		var funcion = $(this).data('funcion');
		var data = $(this);
		data = form_to_json(data);
		$("#add_new_dj button").addClass('saving');
		ajx(funcion,data).done(function(value) {
		  	console.log("Respuesta")
			console.dir(value);
			$("#add_new_dj button").removeClass('saving');
			$("#add_new_dj button").addClass('saved');
			setTimeout(function() {
				$("#add_new_dj button").removeClass('saved');
				reset_fields();
			}, 5000);
		})
		.fail(function(error) {
			$("#add_new_dj button").removeClass('saving');
			$("#add_new_dj button").addClass('retry');
			setTimeout(function() {
				$("#add_new_dj button").removeClass('retry');
				reset_fields();
			}, 5000);
		});
	});

});//fin de documento