(function( $ ) {
	'use strict';

	$(document).ready(function() {
		(function($){
			var multiples_inputs = $( '.multiples-inputs' ),
			input_wrap_clone = multiples_inputs.find( '.input-wrap' ).last().html();

			refresh_control_elements(multiples_inputs);

			multiples_inputs.on( 'click', '.plus', function(e) {
				e.preventDefault();

				multiples_inputs.append( '<div class="input-wrap">' + input_wrap_clone + '</div>' ).find( '.input-wrap' ).last().find( 'input' ).val( '' );
				refresh_control_elements(multiples_inputs);
			}).on( 'click', '.minus', function(e) {
				e.preventDefault();

				$(this).parent().remove();
				refresh_control_elements(multiples_inputs);
			});
		})(jQuery);
	});

})( jQuery );

function refresh_control_elements(multiples_inputs) {
	var input_wrap = multiples_inputs.find( '.input-wrap' ),
		length = input_wrap.length,
		counter = 1;

	input_wrap.each(function(){
		jQuery(this).find( '.minus, .plus' ).remove();

		if ( counter < length ) {
			jQuery(this).append( '<a href="#" class="minus">-</a>' );
		} else {
			jQuery(this).append( '<a href="#" class="plus">+</a>' );
		}

		counter++;
	});
}