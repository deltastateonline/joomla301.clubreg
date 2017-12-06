/**
* create an empty object, which we can set values later on
* regdiv_{id} alerts are written into this container
* regdata_{id} member information are stored in here
* Config for saving alert
*/
function alertSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {}	;	
	
	self.rBefore = beforeAction;
};

alertSaveRequestDef.prototype.useResults = function(response){	

	Joomla.renderMessages({message:response.message});	
	
	var memberId = response.member_id;
	jQuery('#regdiv_'+memberId).fadeOut('slow', function(){
		jQuery('#regdata_'+memberId).fadeIn();		
	});
	
	
}

alertSaveRequestDef.prototype.useFailedResults = function(response){	
	if(response.error){		
		Joomla.renderMessages({error:response.error});					
	}
}

ClubregObjectDefinition.prototype.saveAlert= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig);  
}

var alertSaveRequestConfig = new alertSaveRequestDef() ; 

jQuery(document).ready(function(){
	
	jQuery(document).on('submit','#alert-form',function(event){	
		jQuery(this).find('button').attr('disabled',true);//
		event.preventDefault();			
		alertSaveRequestConfig.rData = jQuery(this).serialize();
		
		ClubRegObject.saveAlert(alertSaveRequestConfig);		
		
	});
});