//profile-contactlist-button

jQuery(document).ready(function() {
	
	jQuery('#contactlistFormDiv').fadeOut();
	
	var isOn = 0;
	
	jQuery(document).on('click','a.profile-contactlist-button',function(event){		
		//jQuery('#btImportCsv').attr('disabled','disabled');	
		//jQuery('#loading-div').addClass('loading-small');
		isOn = 1 - isOn;
		jQuery('#contactlistFormDiv').fadeToggle();
		jQuery('#profile-contactlist').fadeToggle();
	});	
	
	
	jQuery(document).on('click','#toggle-contactlist-div',function(event){
		
		jQuery('#contactlistFormDiv').fadeToggle();
		jQuery('#profile-contactlist').fadeToggle();
	
	});	
	
	jQuery(document).on('submit','#contactlist-form',function(event){		
		
		event.preventDefault();		
		contactSaveRequestConfig.rData = jQuery(this).serialize();
		ClubRegObject.saveContactlist(contactSaveRequestConfig);
		
	});
	
	ClubRegObject.editContacts(contactButtonsRequestConfig);
	

});


function contactSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

contactSaveRequestDef.prototype.useResults  = function(response){	
	
	 s_or_f = 1;
	render_msg(response.msg);
	
	if(response.isNew){
		
	}else{
		
	}
	
	
}

function contactButtonRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=contactlist&layout=edit&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};
contactButtonRequestDef.prototype.useResults  = function(response){	
	jQuery("#contactlistFormDiv").html(response);
}


/**
 * Config for button click request
 */
var contactButtonsRequestConfig = new contactButtonRequestDef();
var contactSaveRequestConfig = new contactSaveRequestDef();

ClubregObjectDefinition.prototype.editContacts= function(requestConfig){
	
	self = this;	
	requestConfig.rData = JSON.decode(jQuery("#contactlistFormDiv").attr('rel'));	
	self.loadAjaxRequestHTML(requestConfig);  

}

ClubregObjectDefinition.prototype.saveContactlist= function(requestConfig){
	
	self = this;	
	self.loadAjaxRequest(requestConfig);  

}