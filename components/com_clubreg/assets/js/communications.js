// A $( document ).ready() block.
jQuery( document ).ready(function() {
	console.log( "ready!" );
	
	jQuery( document ).on('click','a.template-action',function(event){
		
		template_id = jQuery(this).data('template_id');
		//jQuery( document ).location = ''
		
	});
});