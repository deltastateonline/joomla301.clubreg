
function expresscheckinButtonRequestDef(){
		self = this;
		self.rUrl  =  "";
		self.rMethod  = "post";
		self.rData  = {}	;	
};
expresscheckinButtonRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();
	
	console.log(response);
}

/**
 * Config for button click request
 */
var expresscheckinButtonsRequestConfig = new expresscheckinButtonRequestDef();

jQuery(document).ready(function(){
	
	jQuery('#express-checkin-div').on('click','a.btn',function(){
		var searchValue  = jQuery('#expresscheckin-adminForm #search_value').val();
		searchValue = jQuery.trim(searchValue);
		if(searchValue ){		
			jQuery('#expresscheckin-adminForm #express-checkin-div').removeClass('error');
			jQuery('#expresscheckin-adminForm #search_value').val(searchValue);
			expresscheckinButtonsRequestConfig.rData = jQuery('#expresscheckin-adminForm').serialize();			
			ClubRegObject.loadAjaxRequest(expresscheckinButtonsRequestConfig);
		}else{
			jQuery('#expresscheckin-adminForm #express-checkin-div').addClass('error');
		}		
	});
	
});