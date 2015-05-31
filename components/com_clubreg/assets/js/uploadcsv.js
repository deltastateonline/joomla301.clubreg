jQuery( document ).ready(function() {

	
	jQuery( document ).on('submit','#uploadcsvf-form',function(event){		
		
		jQuery('#btImportCsv').attr('disabled','disabled');	
		jQuery('#loading-div').addClass('loading-small');
	});

});