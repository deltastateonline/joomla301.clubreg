
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
 * create an empty object, which we can set values later on
 */
function alertsRequestDef(){
	self = this;
	self.rUrl  =  "";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

alertsRequestDef.prototype.useResults = function(response){
	
	self = this;	
	
	jQuery(self.whereTo).removeClass("loading1");	
	jQuery(self.whereTo).html(response);
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

var alertRequestConfig = new alertsRequestDef();

jQuery(document).ready(function(){
	
	jQuery('#find-player-div').on('click','a.btn-findplayer-search',function(){
		ClubRegObject.runFindPlayer();
	});
	
	jQuery('#findplayerAdminForm').on('keyup','#search_value',ClubRegObject.debounce(
		function(){
			ClubRegObject.runFindPlayer();
		},250)		
	);		
	
	jQuery('#find-player-list').on('click','[rel=anniversary]',function(){
		
		var memberId = jQuery(this).data('memberid');
		jQuery('#regdiv_'+memberId).addClass("loading1");
		jQuery('#regdata_'+memberId).fadeOut('slow',function(){
			jQuery('#regdiv_'+memberId).fadeIn();
		});
		
		var alertdata = jQuery(this).data('alertdata');
		
		alertdata[token] = 1;
		
		var params = "option=com_clubreg&view=alert&layout=edit&tmpl=component&format=raw";		
		alertRequestConfig.rUrl =  "index.php?"+params;	
		alertRequestConfig.rData = alertdata;
		alertRequestConfig.whereTo = '#regdiv_'+memberId;		
		ClubRegObject.loadAjaxRequestHTML(alertRequestConfig);	
		
	});
	
	
	jQuery('#find-player-list').on('click','.toggle-alerts-div',function(){
		
		var memberId = jQuery(this).data('memberid');
		jQuery('#regdiv_'+memberId).fadeOut('slow', function(){
			jQuery('#regdata_'+memberId).fadeIn();		
		});
		
	});
	
	
	
});
