
function findplayerSearchRequestDef(){
		self = this;
		self.rUrl  =  "";
		self.rMethod  = "post";
		self.rData  = {}	;	
};
findplayerSearchRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();	
	jQuery("#find-player-list").removeClass('loading1');
	jQuery("#find-player-list").html(response);	
}

/**
 * 
 */
ClubregObjectDefinition.prototype.runFindPlayer = function(){
	
	var searchValue  = jQuery('#findplayerAdminForm #search_value').val();
	searchValue = jQuery.trim(searchValue);
	if(searchValue){		
		
		jQuery("#find-player-list").html("");	
		jQuery("#find-player-list").addClass('loading1');			
		
		jQuery('#findplayerAdminForm #find-player-div').removeClass('error');
		jQuery('#findplayerAdminForm #search_value').val(searchValue);
		findplayerSearchRequestConfig.rData = jQuery('#findplayerAdminForm').serialize();	
		
		ClubRegObject.loadAjaxRequestHTML(findplayerSearchRequestConfig);
	}else{
		jQuery('#findplayerAdminForm #find-player-div').addClass('error');
	}	
}

function findPlayerButtonRequestDef(){
	self = this;
	self.rUrl  =  "";
	self.rMethod  = "post";
	self.rData  = {}	;
	self.currentValue = "yes";
};

findPlayerButtonRequestDef.prototype.useResults = function(response){
	
	if(response.proceed){
		
		if(response.pk){
			var cDiv = jQuery("div.cgroup-div-findplayer").filter("[data-member_key=\""+response.pk+"\"]");		
			
				cDiv.find('a.btn-danger').toggle();	
				cDiv.find('a.btn-success').toggle();					
		}
	}
	
	jQuery('#findplayerAdminForm #findplayer_loading').removeClass('loading-small');
}


/**
 * Config for button click request
 */
var findplayerSearchRequestConfig = new findplayerSearchRequestDef();
var findplayerButtonRequestConfig = new findPlayerButtonRequestDef();

jQuery(document).ready(function(){
	
	jQuery('#find-player-div').on('click','a.btn-findplayer-search',function(){
		ClubRegObject.runFindPlayer();
	});
	
	jQuery('#findplayerAdminForm').on('keyup','#search_value',ClubRegObject.debounce(
		function(){
			ClubRegObject.runFindPlayer();
		},250)		
	);	
	
	/**
	 * Checkin  or checkout button has been clicked
	 */
	jQuery('#find-player-list').on('click','a.btn-findplayer',function(){
		var self = this;
		
		//
		findplayerButtonRequestConfig.currentValue = jQuery(this).data('statsvalue');  
    	var proceed = true;
    	
    	var memberKey = jQuery(this).parents('div.cgroup-div-findplayer').data('member_key');
    	
    	jQuery('#findplayerForm #pk').val(memberKey);	
    	
    	// set the stats date        	
    	var statsDate = jQuery("#findplayerAdminForm #stats_date").val();
    	jQuery('#findplayerForm #stats_date').val(statsDate);
    	
    	// set the stats value        	
    	jQuery('#findplayerForm #stats_value').val(findplayerButtonRequestConfig.currentValue);    
    	
    	jQuery('#findplayerAdminForm #findplayer_loading').addClass('loading-small');  
   
    	findplayerButtonRequestConfig.rData = jQuery('#findplayerForm').serialize();   	
    	ClubRegObject.loadAjaxRequest(findplayerButtonRequestConfig);
	});
});
