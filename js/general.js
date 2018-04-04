$(document).ready(function(){
	$(document).on('click', '.shadow', function(event) {
		// event.preventDefault();
		var target = event.target.className;
		var shadow_width = $(".active").width();
		var shadow_height = $(".active").height();
		if (target == "shadow") {
			$(".popup").removeClass('active');
			$("general").removeClass('blur');
			$(".shadow").addClass('hidden');
		}
		if (event.offsetX > shadow_width && event.offsetY < 24) {
			$(".popup").removeClass('active');
			$("general").removeClass('blur');
			$(".shadow").addClass('hidden');
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
