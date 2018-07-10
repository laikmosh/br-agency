$(document).ready(function(){ 

	$(document).on('submit', '#login_form', function(event) {
		event.preventDefault();
		var funcion = $(this).data('funcion');
		var data = $(this);
		data = form_to_json(data);
		$("#login_form button").addClass('wait');
		ajx(funcion,data).done(function(value) {
		  	location.reload();
		  	console.log("login exitoso");
		  	console.dir(value);
		})
		.fail(function(error) {
			$("#login_form button").removeClass('wait').addClass('login_error');
			setTimeout(function() {
				$("#login_form button").removeClass('login_error');
			}, 1000);
		});
	});

// copiar en general:
	$(document).on('click touchstart', '#logout', function(event) {
		event.preventDefault();
		var funcion = "logout";
		var data = {};
		ajx(funcion,data).done(function(value) {
			console.log("logout");
			console.dir(value);
		  	location.reload();
		})
		.fail(function(error) {
			console.log("logout");
			console.dir(value);
		});
	});
}); // fin de documento