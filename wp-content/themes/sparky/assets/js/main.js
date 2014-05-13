// Triggered when the DOM is ready.
$(function() {
	
	// Load the helpers.
	var helpers = new Helpers();
	
	// DOM is ready... do yer thang!
	/**
	 * For any element that has a 'bg' data attribute, we will trigger the
	 * backstretch function for it and use the content of the bg data
	 * attribute as the image url.
	 */
	$('[data-bg]').each(function( i , e ) {
		var $element = $(e),
			image_url = $element.data('bg');
		
		$element.backstretch( image_url );
	});
	
});