
function expresscheckinButtonRequestDef(){
		self = this;
		self.rUrl  =  "";
		self.rMethod  = "post";
		self.rData  = {}	;	
};
expresscheckinButtonRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();	
	jQuery("#express-checkin-list").removeClass('loading1');
	jQuery("#express-checkin-list").html(response);	
}

/**
 * Config for button click request
 */
var expresscheckinButtonsRequestConfig = new expresscheckinButtonRequestDef();

jQuery(document).ready(function(){
	
	jQuery('#express-checkin-div').on('click','a.btn',function(){
		var searchValue  = jQuery('#expresscheckinAdminForm #search_value').val();
		searchValue = jQuery.trim(searchValue);
		if(searchValue ){		
			
			jQuery("#express-checkin-list").html("");	
			jQuery("#express-checkin-list").addClass('loading1');			
			
			jQuery('#expresscheckinAdminForm #express-checkin-div').removeClass('error');
			jQuery('#expresscheckinAdminForm #search_value').val(searchValue);
			expresscheckinButtonsRequestConfig.rData = jQuery('#expresscheckinAdminForm').serialize();	
			
			ClubRegObject.loadAjaxRequestHTML(expresscheckinButtonsRequestConfig);
		}else{
			jQuery('#expresscheckinAdminForm #express-checkin-div').addClass('error');
		}		
	});
	
});
/**
 * Stats date has been changed
 */
function expressCheckinDateChanged(){	 
	//ClubRegObject.getStats(statsListRequestConfig,ClubRegObject.currentProfiles);
}