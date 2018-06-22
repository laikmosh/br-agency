
$(document).ready(function(){

	$(document).on('click touchstart', '.restaurar', function(event) {
		var id = $(this).data("id")
		var data = {};
		data["id"] = id;
		ajx("dj_restore",data).done(function(dj) {
		  	console.log("Respuesta")
			console.dir(dj);
			$("#trash_"+id).remove();
			$(".grid_container_djs").prepend(dj["dj_elem"]);
		});
	});

	$(document).on('click touchstart', '.perma_delete', function(event) {
		var id = $(this).data("id")
		var data = {};
		data["id"] = id;
		ajx("dj_perma_delete",data).done(function(dj) {
		  	console.log("Respuesta")
			console.dir(dj);
			$("#trash_"+id).remove();
			$(".trash_cont").prepend(dj["removed"]);
		});
	});

	$(document).on('click', '.edit_dj', function(event) {
		var id = $(this).data("id");
		var data = {};
		data["id"] = id;
		ajx("dj_data",data).done(function(dj) {
		  	console.log("Respuesta")
			console.dir(dj);
			valores = dj["dj"];

			$("input[name=dj_name]").val(valores["dj_name"]);
			$("input[name=nombre]").val(valores["nombre"]);
			$("input[name=apellido]").val(valores["apellido"]);
			$("input[name=email]").val(valores["email"]);
			$("input[name=telefono]").val(valores["telefono"]);
			$("input[name=edad]").val(valores["edad"]);
			$('select[name=location]').val(valores["location"]).prop('selected', true);
			$("textarea[name=bio]").val(valores["bio"]);
			$("input[name=temp_id]").val(id);
			$("input[name=temp_id_pdf]").val(id);
			$("input[name=editing_id]").val(id);
			$("#profile_image_uploader img").attr('src',valores["profile_image"]);
			$('#profile_image_uploader .foto_descr').hide();
			$('input:radio[name=venue]').val([valores["venue"]]);
			$('input:radio[name=genero]').val([valores["genero"]]);
			$(".btn_popup").click();
			$(".file_progress_container_text").html(valores["presskit"]);
			valores["lineup"] = valores["lineup"].split(":");
			valores["lineup"].forEach(function(lineup) {
	          $("#potencia_"+lineup).prop( "checked", true );
	        });
			// $('input:radio[name=lineup]').val([valores["lineup"]]);
		});
	});

	$(document).on('click touchstart', '.remove_dj', function(event) {
		var id = $(this).data("id")
		var data = {};
		data["id"] = id;
		ajx("dj_remove",data).done(function(dj) {
		  	console.log("Respuesta")
			console.dir(dj);
			$("#dj_"+id).remove();
		});
	});

	window.addEventListener("dragover",function(e){
  e = e || event;
  e.preventDefault();
},false);
window.addEventListener("drop",function(e){
  e = e || event;
  e.preventDefault();
},false);
var imageLoader = $(".input_image_single");  //cargar imagen en cuadro
var afuera = document.getElementById("shadow");
console.dir(afuera);
afuera.addEventListener("drop", drop, false);
imageLoader.each(function(index, el) {
	el.addEventListener('change', handleImage, false);
});
function handleImage(e) {
	console.log("triggered handleImage");
	var id = e.target;
	id = id.parentElement.parentElement.id;
	console.log("id="+id);
	console.dir(e);
	var reader = new FileReader();
	reader.onload = function (event) {
		$('#'+id+' img').attr('src',event.target.result);
		$('#'+id+' .foto_descr').hide();
	  	$( '#'+id+" .img_progress" ).show();
	  	$( '#'+id ).submit();
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
  var field = target.id;
  var files = dt.files;
  target.files = files;
  $(this).removeClass('dragover');

}

var progress = function(parent){
	return function(e){
	    if(e.lengthComputable){
	        var max = e.total;
	        var current = e.loaded;

	        var Percentage = (current * 100)/max;
	        var Percentage_left = 100 - Percentage;
	        $( "#"+parent+" .img_progress" ).css("width",Percentage_left+"%").show(); 
	        console.log("LOADING... "+Percentage_left+"% left");


	        if(Percentage >= 100)
	        {
	           console.log(parent+" completado");
	           $( "#"+parent+" .img_progress" ).css("width",Percentage_left+"%"); 
	           console.log("LOADING... "+Percentage_left+"0% left, COMPLETED");

           		setTimeout(function() {
					$( "#"+parent+" .img_progress" ).css("width","100%").hide();
				}, 500);
	        }
	    }  
	}
 }

$("#images_profile").on('submit',(function(e) {
  e.preventDefault();
  var parent = "images_profile";
  console.log("submitting="+parent);
  $.ajax({
	url: location.href,
	type: 'POST',
	dataType: 'json',
  data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
  contentType: false,       // The content type used when sending data to the server.
  cache: false,             // To unable request pages to be cached
  processData:false,        // To send DOMDocument or non processed data file it is set to false
  xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',progress(parent), false);
                }
                return myXhr;
        },
  beforeSend: function() {
			console.log("Función="+parent);
			// console.dir(datos_ans);
 },
 success: function respuesta(datos_ans) {
            console.dir(datos_ans);
            var temp_id = datos_ans["temp_img"];
            console.log('input[name=temp_id]='+temp_id);
            $("input[name=temp_id]").val(temp_id);
 },
    error: function (response) {
      // error
      console.dir(response);
      console.log(response);
    }  
  }); 
})); 

$("#presskit").on('submit',(function(e) {
var size = formatBytes(document.getElementById('presskit_input').files[0].size);
var name = document.getElementById('presskit_input').files[0].name;
console.log("inicia carga pdf");
  e.preventDefault();
  var parent = "presskit";
  console.log("submitting="+parent);
  $.ajax({
	url: location.href,
	type: 'POST',
	dataType: 'json',
  data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
  contentType: false,       // The content type used when sending data to the server.
  cache: false,             // To unable request pages to be cached
  processData:false,        // To send DOMDocument or non processed data file it is set to false
  xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',progress(parent), false);
                }
                return myXhr;
        },
  beforeSend: function() {
			console.log("Función="+parent);
			// console.dir(datos_ans);
 },
 success: function respuesta(datos_ans) {
            console.dir(datos_ans);
            var temp_id = datos_ans["temp_img"];
            console.log('input[name=temp_id]='+temp_id);
            $("input[name=temp_id_pdf]").val(temp_id);
            $(".file_progress_container_text").html("<b>"+name+"</b> "+size);
 },
    error: function (response) {
      // error
      console.dir(response);
      console.log(response);
    }  
  }); 
})); 
	$(document).on('change', 'input[name=presskit]', function(event) {
		console.log("subiendo pdf");
		$( '#presskit' ).submit();
	});



	$(document).on("click",".delete_elem", function(event) {
		$("input[name=temp_id_pdf]").val("delete");
        $(".file_progress_container_text").html("Seleccionar archivo...");
	});


	$(document).on('change', 'input[name=venue]', function(event) {
		var tipo = $('input[name=venue]:checked').val();
		$('.generos + label').hide();
		$('.generos_'+tipo+" + label").show();
	});

	$(document).on('submit', '#add_new_dj', function(event) {
		event.preventDefault();
		var id = $("input[name=editing_id]").val();
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
			if (id != "null") {
				$("#dj_"+id).replaceWith(value["dj_elem"]);
			} else {
				$(".grid_container_djs").prepend(value["dj_elem"]);
			}
			$("#dj_"+id).click();
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
			if(index == "temp_id" && val == "null") {
				$(".shadow").scrollTop( $("#cont_"+index).offset().top );
				$(".foto_label").addClass('dragover'); 
			 	setTimeout(function() {
					$(".foto_label").removeClass('dragover'); 
				}, 3000);
				throw new Error("Foto necesaria");
			}

			if (index == "email") {
			 	email_valid = email_valid.test(val);
			 	if (!email_valid) {
			 		$("input[name=email]").focus();
			 		throw new Error("Email inválido");
			 	}
			}
			 if (index == "venue" || index == "genero" || index == "lineup") {
			 	if (val == "empty") {
			 		$("#cont_"+index).addClass('cont_error');
			 		$(".shadow").scrollTop( $("#cont_"+index).offset().top ); 
 					setTimeout(function() {
						$("#cont_"+index).removeClass('cont_error');
					}, 4000);
			 		throw new Error("Estilo incompleto");
			 	}
			 }
		});
	}

});//fin de documento