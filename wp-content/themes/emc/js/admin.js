jQuery(document).live('acf/setup_fields', function(e, div){
 
	// div is the element with new html.
	// on first load, this is the $('#poststuff')
	// on adding a repeater row, this is the tr
 
	jQuery(div).find('select').each(function(){
 
		jQuery(this).chosen();
 
	});
 
});