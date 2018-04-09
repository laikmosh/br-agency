
$(document).ready(function(){
var imageLoader = $(".input_image_single");  //cargar imagen en cuadro
imageLoader.each(function(index, el) {
	el.addEventListener('change', handleImage, false);
});
function handleImage(e) {
	console.log("triggered handleImage");
	var id = e.target;
	id = id.parentElement.id;
	console.log("id="+id);
	var reader = new FileReader();
	reader.onload = function (event) {
	$('#'+id+' img').attr('src',event.target.result);
	$('#'+id+' .foto_descr').hide();
	}
	reader.readAsDataURL(e.target.files[0]);
}

var dropbox;
dropbox = $(".input_cont");
dropbox.each(function(index, el) {
	el.addEventListener("dragenter", dragenter, false);
	el.addEventListener("dragleave", dragleave, false);
	el.addEventListener("dragover", dragover, false);
	el.addEventListener("drop", drop, false);	
});
function dragenter(e) {
  e.stopPropagation();
  e.preventDefault();
  console.log("triggered dragenter");
  $(this).addClass('dragover');
}
function dragleave(e) {
  e.stopPropagation();
  e.preventDefault();
  console.log("triggered dragleave");
  $(this).removeClass('dragover');
}
function dragover(e) {
  e.stopPropagation();
  e.preventDefault();
  console.log("triggered dragover");
}
function drop(e) {
  e.stopPropagation();
  e.preventDefault();
  console.log("triggered drop");
  var target = e.target;
  console.dir(e);
  var dt = e.dataTransfer;
  // console.dir(dt);
  var files = dt.files;
  target.files = files;
  $(this).removeClass('dragover');
}







	$(document).on('change', 'input[name=venue]', function(event) {
		var tipo = $('input[name=venue]:checked').val();
		$('.generos + label').hide();
		$('.generos_'+tipo+" + label").show();
	});

	$(document).on('submit', '#add_new_dj', function(event) {
		event.preventDefault();
		var funcion = $(this).data('funcion');
		var data = $(this);
		data = form_to_json(data);
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

	function validaciones(form) {
		var email_valid = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$.each(form, function(index, val) {
			console.log("index="+index+" value="+val);
			 if (index == "email") {
			 	console.log("es email")
			 	email_valid = email_valid.test(val);
			 	if (!email_valid) {
			 		$("input[name=email]").focus();
			 		throw new Error("no es email valido2");
			 	}
			 }
			 if (index == "venue" || index == "genero" || index == "lineup") {
			 	if (val == "empty") {
			 		$("#cont_"+index).addClass('cont_error');
			 		$(".shadow").scrollTop( $("#cont_"+index).offset().top ); 
 					setTimeout(function() {
						$("#cont_"+index).removeClass('cont_error');
					}, 4000);
			 		throw new Error("radios vacios");
			 	}
			 }
		});
	}

});//fin de documento