$(document).ready(function(){

	var height = $(window).height();

	ajustesIniciales();

	function ajustesIniciales(){
		$("section#body").css({"margin-top": height - 100 + "px"});
	}

	$(document).scroll(function(){
		var scrollTop = $(this).scrollTop();
		var pixels = scrollTop / 100;

		if(scrollTop < height){
			$("#main-slider .slider-item").css({
				"-webkit-filter": "blur(" + pixels + "px)",
				"-moz-filter": "blur(" + pixels + "px)",
				"filter": "blur(" + pixels + "px)",
				"background-position": "center -" + pixels * 25 + "px"
			});
		}
	});
});