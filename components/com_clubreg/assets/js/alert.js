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

function alertDeleteRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&task=alert.delete&tmpl=component";
	self.rMethod  = "post";
	self.rData  = {}	;	
	
	self.rBefore = beforeAction;
	self.requestcreator = {};
};

alertSaveRequestDef.prototype.useResults = function(response){	

	Joomla.renderMessages({message:response.message});	
	
	var memberId = response.member_id;
	jQuery('#regdiv_'+memberId).fadeOut('slow', function(){
		jQuery('#regdata_'+memberId).fadeIn();		
	});
	
}

alertDeleteRequestDef.prototype.useResults = function(response){

	Joomla.renderMessages({message:response.message});
	self = this;	
	self.requestcreator[response.alert_key].fadeOut();
	
}

alertDeleteRequestDef.prototype.useFailedResults = function(response){	
	if(response.error){		
		Joomla.renderMessages({error:response.error});					
	}
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

ClubregObjectDefinition.prototype.deleteAlert= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig);  
}

var alertSaveRequestConfig = new alertSaveRequestDef() ; 
var alertDeleteRequestConfig = new alertDeleteRequestDef() ; 

jQuery(document).ready(function(){
	
	jQuery(document).on('submit','#alert-form',function(event){	
		jQuery(this).find('button').attr('disabled',true);//
		event.preventDefault();			
		alertSaveRequestConfig.rData = jQuery(this).serialize();
		
		ClubRegObject.saveAlert(alertSaveRequestConfig);		
		
	});
	
	
	jQuery(document).on('click',"a[data-alertinfo]",function(event){	
		
		var deleteme = confirm("Are you sure you want to delete this item?");
		
		if(deleteme){		
			
			var aObject = jQuery(this).data('alertinfo');	
			event.preventDefault();			
			alertDeleteRequestConfig.rData = aObject;
			
			// save the creator object so that it can be used later		
			alertDeleteRequestConfig.requestcreator[aObject.alert_key] = jQuery(this).closest('div.row-fluid');			
			ClubRegObject.deleteAlert(alertDeleteRequestConfig);	

		}
	})
});