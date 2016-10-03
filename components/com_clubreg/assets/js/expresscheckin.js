
function expresscheckinButtonRequestDef(){
		self = this;
		self.rUrl  =  "";
		self.rMethod  = "post";
		self.rData  = {}	;	
};

/**
 * Config for button click request
 */
var expresscheckinButtonsRequestConfig = new expresscheckinButtonRequestDef();

jQuery(document).ready(function(){
	
	jQuery('#express-checkin-div').on('click','a.btn',function(){
		
		
		
		expresscheckinButtonsRequestConfig.rData = jQuery('#expresscheckin-adminForm').serialize(); 
		
		
		ClubRegObject.loadAjaxRequest(expresscheckinButtonsRequestConfig);
		
	});
	
});