$(document).ready(function(){ 
	if (name_get != "") {
		console.log("name_get="+name_get);
		// $("#dj_"+name_get+".btn_popup").click();
		var target = $("#dj_"+name_get).data('target');
		console.log("target="+target);
		$(".popup."+target).addClass('active');
		$("general").addClass('blur');
		$(".shadow").removeClass('hidden');
		var funcion = "dj_page";
		var data = {
			"id":name_get
		};
		ajx(funcion,data).done(function(value) {
			console.log("Ans:");
			console.dir(value);
			$(".dj_page").html(value["dj_page"]);
		})
		.fail(function(error) {
			console.log("ans");
			console.dir(value);
		});
	};
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

	$(document).on('click touchstart', 'html', function(event) {
		// event.preventDefault();
		var target = event.target.className;
		// console.log("name="+target);
		if (target == "html") {
			target = "/agency";
			if ( $(".selected").length > 0 && $(".cont_new_dj").length == 0) {history.pushState( { "target": target}, target, target); };
			console.log("reset grid");
			$(".selected").removeClass('selected');
		}
	});

	$(document).on('click', '.grid_elem', function(event) {
		$(".selected").removeClass('selected');
		$(this).addClass('selected');
		var target = $(this).data('dj_name');
		target = "/agency/"+target;
		if ( $(".cont_new_dj").length > 0 ) {} else { history.pushState( { "target": target}, target, target); };

		var name_get = $(this).data('id');
		var funcion = "dj_page";
		var data = {
			"id":name_get
		};
		ajx(funcion,data).done(function(value) {
			console.log("Ans:");
			console.dir(value);
			$(".dj_page").html(value["dj_page"]);
		})
		.fail(function(error) {
			console.log("ans");
			console.dir(value);
		});
	});

	$(document).on('click touchstart', '.shadow', function(event) {
		// event.preventDefault();
		var target = event.target.className;
		var shadow_width = $(".active").width();
		var shadow_height = $(".active").height();
		if (target == "shadow") {
			if ($(".lightbox").hasClass('active')) {
				$(".lightbox").removeClass('active');
				$(".dj_page").addClass('active');
			} else {
				reset_fields();
			}
		}
		if (event.offsetX > shadow_width && event.offsetY < 24) {
			if ($(".lightbox").hasClass('active')) {
				$(".lightbox").removeClass('active');
				$(".dj_page").addClass('active');
			} else {
				reset_fields();
			}
		}
	});
	$(document).on('click touchstart', '.btn_popup', function(event) {
		event.preventDefault();
		$(".popup").removeClass('active');
		$("general").removeClass('blur');
		$(".shadow").addClass('hidden');
		var target = $(this).data('target');
		console.log("target="+target);
		$(".popup."+target).addClass('active');
		$("general").addClass('blur');
		$(".shadow").removeClass('hidden');
	});

	$(document).on('click touchstart', '.popup', function(e) {
        var posX = $(".popup.active").offset().left + $(".popup.active").width(),
            posY = $(".popup.active").offset().top;
            posX = parseInt(Math.abs(e.pageX - posX)),
            posY = parseInt(e.pageY - posY);
        if (posX <= 25 && posY <= 25) {
        	$(".shadow").click();
        }
	});

	$(document).on('click touchstart', '.gallery_thumb', function(event) {
		event.preventDefault();
		var gallery = $(this).data('gallery');
		var key = $(this).data('key');
		var data = {
			"gallery":gallery,
			"key":key
		};
		var funcion = "gallery";
		ajx(funcion,data).done(function(value) {
			console.log("respuesta");
			console.dir(value);
			var gallery = value["gallery"]
			$(".lightbox").html(gallery);
		})
		// .fail(function(error) {
		// 	console.log("logout");
		// 	console.dir(value);
		// });
	});

$(document).keydown(function(e){
    if (e.keyCode > 36 && e.keyCode < 41) 
      console.log("presionado:"+e.keyCode);
  if (e.keyCode == 39) {
      var $next = $(".gallery_img.activ").removeClass('activ').next(".gallery_img");  
      if ($next.length) {
      	$next.addClass('activ');
      } else {
      	$(".gallery_img:first").addClass('activ');
      }
      }   
        if (e.keyCode == 37) {
      var $next = $(".gallery_img.activ").removeClass('activ').prev(".gallery_img");  
      if ($next.length) {
      	$next.addClass('activ');
      } else {
      	$(".gallery_img:last").addClass('activ');
      }
      }     
});

});//fin de documento

function ajx(funcion,data) {
		data["function"]=funcion;
		return $.ajax({
        url: location.href,
        type: 'post',
        dataType: 'json',
        data: {'datos':data},
        tryCount : 0,
	    retryLimit : 3,
        beforeSend: function enviando_datos() {
			console.log("Función="+funcion);
			console.dir(data);
		},
        success: function respuesta(datos_ans) {
            // console.dir(datos_ans);
            // return datos_ans;
       },
        error : function ajax_error(xhr, textStatus, errorThrown ) {
	        if (xhr.status == 500) {
	            console.error("Fallo en servidor, error 500: "+errorThrown+" : "+textStatus);
	            console.dir(xhr);
	        } else {
	            console.error("Error: "+errorThrown+" : "+textStatus);
	            console.dir(xhr);
	        }
	     	if (xhr) {
	        	if (xhr["responseJSON"]["login_check"] == "unlogged") {
	        		location.reload();
	        	}
	        }
	        if (textStatus == 'timeout') {
	            this.tryCount++;
	            if (this.tryCount <= this.retryLimit) {
	                console.error("Tiempo excedido, reintento "+this.tryCount+" de "+this.retryLimit+").");
	                $.ajax(this);
	            }            
	        }
	    }
    }); //fin de ajax
}; // fin de funcion ajx()



function form_to_json(data) {
	data = data.serializeArray()
		var datos = {};
		$.each(data, function(index, val) {
			var name = val["name"];
			var value = val["value"];
			 datos[name]=value;
			 if (name == "reviewed[]") {
			 	datos["djs"] = $("input[name='reviewed[]']:checked").map(function() {return this.value;}).get().join(':');
			 	console.log("djs:"+datos[name]);
			 }
			 if (name == "lineup") {
			 	datos["lineup"] = $("input[name='lineup']:checked").map(function() {return this.value;}).get().join(':');
			 	console.log("lineup:"+datos["lineup"]);
			}
		});
	return datos;
};

function reset_fields() {
	$(".popup").removeClass('active');
	$("general").removeClass('blur');
	$(".shadow").addClass('hidden');
	$("form").trigger("reset");
	$(".generos + label").show();
	$('form img').attr('src',"");
	$('form .foto_descr').show();
	$('.nullify').val("null");
	$("#frame_edit_cont").html('<span class="gallery_pre">Guarda el perfil para agregar fotos a la galería</span>');
	$(".dj_page").html('<span class="loading">Cargando...</span>');
	target = "/agency";
	if ( $(".selected").length > 0 && $(".cont_new_dj").length == 0) {history.pushState( { "target": target}, target, target); };
};

function formatBytes(bytes) {
    if(bytes < 1024) return bytes + " Bytes";
    else if(bytes < 1048576) return(bytes / 1024).toFixed(1) + " KB";
    else if(bytes < 1073741824) return(bytes / 1048576).toFixed(1) + " MB";
    else return(bytes / 1073741824).toFixed(2) + " GB";
};


