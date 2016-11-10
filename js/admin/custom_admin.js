
// jQuery(function() {
// 	function cmb2_custom_validation_before_fill(check){
// 		var fields = [
// 						'yourprefix_demo_textsmall',
// 						'yourprefix_demo_textmedium', 
// 					];
// 		if (jQuery('#' + check).prop('checked')) {
// 			for (var i = 0; i < fields.length; i++) {
// 				jQuery('#' + fields[i]).attr('data-validation', 'required');
// 			}
// 		}else{
// 			for (var i = 0; i < fields.length; i++) {
// 				jQuery('#' + fields[i]).attr('data-validation', '');
// 			}
// 		}
// 	}

// 	var check = 'show-in-slider';
// 	cmb2_custom_validation_before_fill(check);
// 	var input = jQuery('#' + check);
// 	input.change(function(){
// 		cmb2_custom_validation_before_fill(check);
// 	})
// })

jQuery(function(){
	jQuery(".hide-clone").parentsUntil(".cmb-row").fadeOut();
	jQuery(".hide-remove").parentsUntil(".cmb-remove-field-row").fadeOut();

	var input = jQuery('#show-in-slider');
	var group = jQuery('#slider-group-fields_repeat');
	
	if (jQuery(input).prop('checked')) {
		group.slideDown();
	}else{
		group.slideUp();
	}
	input.change(function(){
		if (jQuery(input).prop('checked')) {
			group.slideDown();
		}else{
			group.slideUp();
		}
	})
})