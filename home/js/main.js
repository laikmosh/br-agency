$(document).ready(function(){
	$(document).on('change', 'input[name=selected]', function(event) {
		selected_djs();
	});

	function selected_djs() {
		$(".dj_review").hide();
		$(".book_button").hide();
		$(".queued").removeClass('queued');
		$("input[name='reviewed[]']").removeAttr('checked');
		$("input[name=selected]:checked").each(function(index) {
			var el = $( this ).val();
			console.log("addclass #dj_"+el)
			$("#dj_"+el).addClass('queued');
			$(".book_button").show();
			$("#review_"+el).show();
			$("#reviewed_"+el).attr('checked','checked');
		});
	};

	$(document).on('change', 'input[name=ubicacion]', function(event) {
		filter_djs();
	});
	$(document).on('change', 'input[name=venue]', function(event) {
		filter_djs();
	});
	$(document).on('change', 'input[name=genero]', function(event) {
		filter_djs();
	});
	$(document).on('change', 'input[name=lineup]', function(event) {
		filter_djs();
	});

	function filter_djs() {
		var ubicacion = $('input[name=ubicacion]:checked').val();
		var venue = $('input[name=venue]:checked').val();
		var genero = $('input[name=genero]:checked').val();
		var lineup = $('input[name=lineup]:checked').val();
		$(".fil_ven").show();

		ubicacion = "_"+ubicacion;
		venue = "_"+venue;
		genero = "_"+genero;
		lineup = "_"+lineup;

		if (ubicacion != "_all") {	$(".fil_ubi").hide();		} else {ubicacion = ""};
		if (venue != "_all") {	$(".fil_ven").hide();		} else {venue = ""};
		if (genero != "_all") {	$(".fil_gen").hide();		} else {genero = ""};
		if (lineup != "_all") {	$(".fil_lin").hide();		} else {lineup = ""};

		$(".fil_ubi"+ubicacion+".fil_ven"+venue+".fil_gen"+genero+".fil_lin"+lineup).show();

		$(".fil_fil").hide();
		$(".fil_fil.fil_ven"+venue).show();

		console.log("show fil_ubi"+ubicacion);
		console.log("show fil_ven"+venue);
		console.log("show fil_gen"+genero);
		console.log("show fil_lin"+lineup);
	}

	$(document).on('submit', '#book_djs', function(event) {
		event.preventDefault();
		var funcion = $(this).data('funcion');
		var data = $(this);
		console.log("data:");
		console.dir(data);
		data = form_to_json(data);
		console.log("data json:");
		console.dir(data);
		validaciones(data);
		$("#add_new_dj button").addClass('saving');
		ajx(funcion,data).done(function(value) {
		  	console.log("Respuesta")
			console.dir(value);
			$("#add_new_dj button").removeClass('saving');
			$("#add_new_dj button").addClass('saved');

			setTimeout(function() {
				$("#add_new_dj button").removeClass('saved');
				reset_fields();
			}, 1500);
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

	function validaciones(form) {
		var email_valid = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$.each(form, function(index, val) {
			console.log("index="+index+" value="+val);

			if (index == "email") {
			 	email_valid = email_valid.test(val);
			 	if (!email_valid) {
			 		$("input[name=email]").focus();
			 		throw new Error("Email inválido");
			 	}
			}
		});
	}


});//fin de documento