(function($){
$(document).ready(function() {
    $("#aan").resizable({ 
		minHeight:50,
		handles:'n,e',
		delay: 50,
		distance: 20,
		alsoResize: ".aa_pre2",
	});
	$("#aao").tabs();
 });

})(jQuery.noConflict())