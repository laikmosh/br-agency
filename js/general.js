$(document).ready(function(){
	$(document).on('click', '.shadow', function(event) {
		// event.preventDefault();
		var target = event.target.className;
		var shadow_width = $(".active").width();
		var shadow_height = $(".active").height();
		if (target == "shadow") {
			reset_fields();
		}
		if (event.offsetX > shadow_width && event.offsetY < 24) {
			reset_fields();
		}
	});
	$(document).on('click', '.btn_popup', function(event) {
		event.preventDefault();
		var target = $(this).data('target');
		$(".popup."+target).addClass('active');
		$("general").addClass('blur');
		$(".shadow").removeClass('hidden');
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
	        if (textStatus == 'timeout') {
	            this.tryCount++;
	            if (this.tryCount <= this.retryLimit) {
	                console.error("Tiempo excedido, reintento "+this.tryCount+" de "+this.retryLimit+").");
	                $.ajax(this);
	            }            
	        }
	        if (xhr.status == 500) {
	            console.error("Fallo en servidor, error 500: "+errorThrown+" : "+textStatus);
	            console.dir(xhr);
	        } else {
	            console.error("Error: "+errorThrown+" : "+textStatus);
	            console.dir(xhr);
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
		});
	return datos;
};

function reset_fields() {
	$(".popup").removeClass('active');
	$("general").removeClass('blur');
	$(".shadow").addClass('hidden');
	$("form").trigger("reset");
	$(".generos + label").show();
};

