function ajx(e,a){return a.function=e,$.ajax({url:location.href,type:"post",dataType:"json",data:{datos:a},tryCount:0,retryLimit:3,beforeSend:function t(){console.log("Función="+e),console.dir(a)},success:function e(a){},error:function e(a,t,o){500==a.status?(console.error("Fallo en servidor, error 500: "+o+" : "+t),console.dir(a)):(console.error("Error: "+o+" : "+t),console.dir(a)),a&&"unlogged"==a.responseJSON.login_check&&location.reload(),"timeout"==t&&++this.tryCount<=this.retryLimit&&(console.error("Tiempo excedido, reintento "+this.tryCount+" de "+this.retryLimit+")."),$.ajax(this))}})}function form_to_json(e){e=e.serializeArray();var a={};return $.each(e,function(e,t){var o=t.name,l=t.value;a[o]=l,"reviewed[]"==o&&(a.djs=$("input[name='reviewed[]']:checked").map(function(){return this.value}).get().join(":"),console.log("djs:"+a[o])),"lineup"==o&&(a.lineup=$("input[name='lineup']:checked").map(function(){return this.value}).get().join(":"),console.log("lineup:"+a.lineup))}),a}function reset_fields(){$(".popup").removeClass("active"),$("general").removeClass("blur"),$(".shadow").addClass("hidden"),$("form").trigger("reset"),$(".generos + label").show(),$("form img").attr("src",""),$("form .foto_descr").show(),$(".nullify").val("null"),$("#frame_edit_cont").html('<span class="gallery_pre">Guarda el perfil para agregar fotos a la galería</span>'),$(".dj_page").html('<span class="loading">Cargando...</span>'),$(".lightbox").html(""),target="/agency",$(".selected").length>0&&0==$(".cont_new_dj").length&&history.pushState({target:target},target,target),$(".selected").removeClass("selected"),$(".nodisp").removeClass("nodisp")}function formatBytes(e){return e<1024?e+" Bytes":e<1048576?(e/1024).toFixed(1)+" KB":e<1073741824?(e/1048576).toFixed(1)+" MB":(e/1073741824).toFixed(2)+" GB"}$(document).ready(function(){if(""!=name_get){console.log("name_get="+name_get);var e=$("#dj_"+name_get).data("target");console.log("target="+e),$(".popup."+e).addClass("active"),$("general").addClass("blur"),$(".shadow").removeClass("hidden");ajx("dj_page",{id:name_get}).done(function(e){console.log("Ans:"),console.dir(e),$(".dj_page").html(e.dj_page)}).fail(function(e){console.log("ans"),console.dir(value)})}$(document).on("click tap","#logout",function(e){e.preventDefault(),ajx("logout",{}).done(function(e){console.log("logout"),console.dir(e),location.reload()}).fail(function(e){console.log("logout"),console.dir(value)})}),$(document).on("click tap","html",function(e){var a=e.target.className;"html"==a&&(a="/agency",$(".selected").length>0&&0==$(".cont_new_dj").length&&history.pushState({target:a},a,a),console.log("reset grid"),$(".selected").removeClass("selected"))}),$(document).on("click",".grid_elem",function(e){$(".selected").removeClass("selected"),$(this).addClass("selected");var a=$(this).data("dj_name");a="/agency/"+a,$(".cont_new_dj").length>0||history.pushState({target:a},a,a),ajx("dj_page",{id:$(this).data("id")}).done(function(e){console.log("Ans:"),console.dir(e),$(".dj_page").html(e.dj_page)}).fail(function(e){console.log("ans"),console.dir(value)})}),$(document).on("click tap",".shadow",function(e){var a=e.target.className,t=$(".active").width(),o=$(".active").height();"shadow"==a&&($(".lightbox").hasClass("active")?($(".lightbox").removeClass("active"),$(".dj_page").addClass("active")):reset_fields()),e.offsetX>t&&e.offsetY<24&&($(".lightbox").hasClass("active")?($(".lightbox").removeClass("active"),$(".dj_page").addClass("active"),$(".lightbox").html("")):reset_fields())}),$(document).on("click tap",".btn_popup",function(e){e.preventDefault(),$(".popup").removeClass("active"),$("general").removeClass("blur"),$(".shadow").addClass("hidden");var a=$(this).data("target");console.log("target="+a),$(".popup."+a).addClass("active"),$("general").addClass("blur"),$(".shadow").removeClass("hidden"),$(".book").hasClass("active")?($(".selected_dj").addClass("nodisp"),$(".book_button").addClass("nodisp")):$(".nodisp").removeClass("nodisp")}),$(document).on("click tap",".popup",function(e){var a=$(".popup.active").offset().left+$(".popup.active").width(),t=$(".popup.active").offset().top;a=parseInt(Math.abs(e.pageX-a)),t=parseInt(e.pageY-t),a<=25&&t<=25&&$(".shadow").click()}),$(document).on("click tap",".gallery_thumb, .profile_img",function(e){e.preventDefault(),ajx("gallery",{gallery:$(this).data("gallery"),key:$(this).data("key")}).done(function(e){console.log("respuesta"),console.dir(e);var a=e.gallery;$(".lightbox").html(a)})}),$(document).on("click tap",".gallery_img",function(e){var a=$(".gallery_img.activ").removeClass("activ").next(".gallery_img");a.length?a.addClass("activ"):$(".gallery_img:first").addClass("activ")}),$(document).keydown(function(e){if(39==e.keyCode){var a=$(".gallery_img.activ").removeClass("activ").next(".gallery_img");a.length?a.addClass("activ"):$(".gallery_img:first").addClass("activ")}if(37==e.keyCode){var a=$(".gallery_img.activ").removeClass("activ").prev(".gallery_img");a.length?a.addClass("activ"):$(".gallery_img:last").addClass("activ")}})});