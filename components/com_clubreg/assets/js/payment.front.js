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

/**
 * After the request has been saved then 
 * {
 * 	isNew: false,
 * 	member_id : "Integer" , 
 * 	msg = [String,String], 
 * 	payment_id: Integer, 
 * 	proceed:true
 * }
 */
paymentSaveRequestDef.prototype.useResults = function(response){	

	Joomla.renderMessages({message:response.msg});	
	
	var memberId = response.member_id;	
	// just find and reload the div
	var found = jQuery("[rel=payment]" ).filter("a.btn-mini").filter("[data-memberid="+memberId+"]").first();
	
	if(found != undefined){	
		jQuery(found).trigger( "click" );	
	}
}


paymentSaveRequestDef.prototype.useFailedResults = function(response){	
	if(response.error){		
		Joomla.renderMessages({error:response.error});					
	}
}

/** send the request **/
ClubregObjectDefinition.prototype.savePayments= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig); 
}


var paymentSaveRequestConfig = new paymentSaveRequestDef() ;


	jQuery(document).ready(function(){
	
	jQuery(document).on('submit','#payment-form',function(event){	
		jQuery(this).find('button').attr('disabled',true);//
		event.preventDefault();			
		paymentSaveRequestConfig.rData = jQuery(this).serialize();
		
		ClubRegObject.savePayments(paymentSaveRequestConfig);	// request sent	
		
	});
	
	
});