/**
* create an empty object, which we can set values later on
* regdiv_{id} alerts are written into this container
* regdata_{id} member information are stored in here
* Config for saving alert
*/
function paymentSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {}	;	
	
	self.rBefore = beforeAction;
};


paymentSaveRequestDef.prototype.useResults = function(response){	

	Joomla.renderMessages({message:response.msg});	
	
	var memberId = response.member_id;
	jQuery('#regdiv_'+memberId).fadeOut('slow', function(){
		jQuery('#regdata_'+memberId).fadeIn();		
	});
	
}


paymentSaveRequestDef.prototype.useFailedResults = function(response){	
	if(response.error){		
		Joomla.renderMessages({error:response.error});					
	}
}



var paymentSaveRequestConfig = new paymentSaveRequestDef() ;


jQuery(document).ready(function(){
	
	jQuery(document).on('submit','#payment-form',function(event){	
		jQuery(this).find('button').attr('disabled',true);//
		event.preventDefault();			
		paymentSaveRequestConfig.rData = jQuery(this).serialize();
		
		ClubRegObject.saveAlert(paymentSaveRequestConfig);		
		
	});
	
	
	
});