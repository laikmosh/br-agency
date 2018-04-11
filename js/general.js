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

// function progress(e){

//     if(e.lengthComputable){
//         var max = e.total;
//         var current = e.loaded;

//         var Percentage = (current * 100)/max;
//         console.log(Percentage);


//         if(Percentage >= 100)
//         {
//            console.log("completado"); 
//         }
//     }  
//  }
// function ajx_file(funcion,data) {
// 		// var fd = new FormData();
// 		// fd.append(field, data);
// 		// fd.append("function", funcion);
// 		// fd.append("field", field);
// 		return $.ajax({
//         url: location.href,
//         type: 'post',
//         dataType: 'json',
//         contentType: false, 
//         cache: false, 
//         processData:false,
//         data: data,
//         tryCount : 0,
// 	    retryLimit : 3,
// 	    xhr: function() {
//                 var myXhr = $.ajaxSettings.xhr();
//                 if(myXhr.upload){
//                     myXhr.upload.addEventListener('progress',progress, false);
//                 }
//                 return myXhr;
//         },
//         beforeSend: function enviando_datos() {
// 			console.log("Función="+funcion);
// 			console.dir(data);
// 		},
//         success: function respuesta(datos_ans) {
//             // console.dir(datos_ans);
//             // return datos_ans;
//        },
//     //    xhr: function() {
// 				// 	var xhr = new XMLHttpRequest();
// 				// 	xhr.upload.addEventListener("progress", function(e) {
// 				// 		if (e.lengthComputable) {
// 				// 			//var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
// 				// 			var uploadpercent = e.loaded / e.total; 
// 				// 			uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
// 				// 			console.log(uploadpercent + '%');
// 				// 			console.log(uploadpercent + '%');
// 				// 			if (uploadpercent == 100) {
// 				// 				console.log('Completed');
// 				// 			}
// 				// 		}
// 				// 	}, false);
					
// 				// 	return xhr;
// 				// },
//         error : function ajax_error(xhr, textStatus, errorThrown ) {
// 	        if (textStatus == 'timeout') {
// 	            this.tryCount++;
// 	            if (this.tryCount <= this.retryLimit) {
// 	                console.error("Tiempo excedido, reintento "+this.tryCount+" de "+this.retryLimit+").");
// 	                $.ajax(this);
// 	            }            
// 	        }
// 	        if (xhr.status == 500) {
// 	            console.error("Fallo en servidor, error 500: "+errorThrown+" : "+textStatus);
// 	            console.dir(xhr);
// 	        } else {
// 	            console.error("Error: "+errorThrown+" : "+textStatus);
// 	            console.dir(xhr);
// 	        }
// 	    }
//     }); //fin de ajax
// }; // fin de funcion ajx()

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

