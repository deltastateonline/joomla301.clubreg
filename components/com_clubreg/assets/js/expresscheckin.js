function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

function expresscheckinSearchRequestDef(){
		self = this;
		self.rUrl  =  "";
		self.rMethod  = "post";
		self.rData  = {}	;	
};
expresscheckinSearchRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();	
	jQuery("#express-checkin-list").removeClass('loading1');
	jQuery("#express-checkin-list").html(response);	
}

ClubregObjectDefinition.prototype.runExpressCheckin = function(){
	
	var searchValue  = jQuery('#expresscheckinAdminForm #search_value').val();
	searchValue = jQuery.trim(searchValue);
	if(searchValue){		
		
		jQuery("#express-checkin-list").html("");	
		jQuery("#express-checkin-list").addClass('loading1');			
		
		jQuery('#expresscheckinAdminForm #express-checkin-div').removeClass('error');
		jQuery('#expresscheckinAdminForm #search_value').val(searchValue);
		expresscheckinSearchRequestConfig.rData = jQuery('#expresscheckinAdminForm').serialize();	
		
		ClubRegObject.loadAjaxRequestHTML(expresscheckinSearchRequestConfig);
	}else{
		jQuery('#expresscheckinAdminForm #express-checkin-div').addClass('error');
	}	
}

function expressCheckinButtonRequestDef(){
	self = this;
	self.rUrl  =  "";
	self.rMethod  = "post";
	self.rData  = {}	;
	self.currentValue = "yes";
};

expressCheckinButtonRequestDef.prototype.useResults = function(response){
	
	if(response.proceed){
		
		if(response.pk){
			var cDiv = jQuery("div.cgroup-div-expresscheckin").filter("[data-member_key=\""+response.pk+"\"]");			
			
			//var statsButton = cDiv.find('a.btn-mini');	
			//statsButton.removeClass('btn-success').addClass('btn-danger'); // remove the styles
			
			//statsButton.html("Chekout")
			if(self.currentValue == "yes"){
				cDiv.find('a.btn-danger').toggle();	
				cDiv.find('a.btn-success').toggle()
			}else if(self.currentValue == "no"){
				cDiv.find('a.btn-danger').toggle();	
				cDiv.find('a.btn-success').toggle()
			}			
		}
	}
}


/**
 * Config for button click request
 */
var expresscheckinSearchRequestConfig = new expresscheckinSearchRequestDef();
var expresscheckinButtonRequestConfig = new expressCheckinButtonRequestDef();

jQuery(document).ready(function(){
	
	jQuery('#express-checkin-div').on('click','a.btn-expresscheckin-search',function(){
		ClubRegObject.runExpressCheckin();
	});
	
	jQuery('#expresscheckinAdminForm').on('keyup','#search_value',debounce(
		function(){
			ClubRegObject.runExpressCheckin();
		},250)		
	);	
	
	jQuery('#express-checkin-list').on('click','a.btn-expresscheckin',function(){
		var self = this;
		
		expresscheckinButtonRequestConfig.currentValue = jQuery(this).data('statsvalue');  
    	var proceed = true;
    	
    	var memberKey = jQuery(this).parents('div.cgroup-div-expresscheckin').data('member_key');
    	
    	jQuery('#expresscheckinForm #pk').val(memberKey);	
    	
    	// set the stats date        	
    	var statsDate = jQuery("#expresscheckinAdminForm #stats_date").val();
    	jQuery('#expresscheckinForm #stats_date').val(statsDate);
    	
    	// set the stats value        	
    	jQuery('#expresscheckinForm #stats_value').val(expresscheckinButtonRequestConfig.currentValue);        	
   
    	expresscheckinButtonRequestConfig.rData = jQuery('#expresscheckinForm').serialize();   	
    	ClubRegObject.loadAjaxRequest(expresscheckinButtonRequestConfig);
	});
});
/**
 * Stats date has been changed
 */
function expressCheckinDateChanged(){	 
	//ClubRegObject.getStats(statsListRequestConfig,ClubRegObject.currentProfiles);
}