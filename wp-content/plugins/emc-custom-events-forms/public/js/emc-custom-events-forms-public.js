(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */
	$( document ).ready( function( ) {
		$('#emc-events-list').dataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
			]
		} );
		var table = $('#emc-events-list').DataTable();
		if( typeof tribe_ev !== 'undefined' ){
		  $(tribe_ev.events).on('tribe_ev_ajaxSuccess', function(){
			var table = $('#emc-events-list').DataTable();
		  });
		}
		// #myInput is a <input type="text"> element
		$('#myInput').on( 'keyup', function () {
			table.search( this.value ).draw();
		} );

		$( '#tribe-add-recurrence' ).after( ' <button id="tribe-remove-recurrence" class="button">Remove Last Rule</button>' ).click(recurrence_rules_count);
		recurrence_rules_count();
		$( '.recurrence-row' ).on( 'click', '#tribe-remove-recurrence', function(e) {
			e.preventDefault();
			var rules = jQuery( '.recurrence-row' ).find( '.tribe-event-recurrence-rule' ).last().remove();

			recurrence_rules_count(true);
		});

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
	} );
})( jQuery );

function recurrence_rules_count(discount) {
	var rules = jQuery( '.recurrence-row' ).find( '.tribe-event-recurrence-rule' );

	if ( true === discount ) {
		rules.length--;
	}

	if ( rules.length > 0 ) {
		jQuery( '#tribe-remove-recurrence' ).fadeIn();
	} else {
		jQuery( '#tribe-remove-recurrence' ).hide();
	}
}

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
