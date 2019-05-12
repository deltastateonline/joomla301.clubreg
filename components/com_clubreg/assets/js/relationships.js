jQuery( document ).ready(function() {
	
	jQuery('#relationshipsFormDiv').fadeOut();
	
	jQuery(document).on('click','a.profile-realtionships-button, a.profile-realtionships-link',function(event){	
		
		jQuery('#relationshipsFormDiv').fadeToggle();
		jQuery('#profile-relationships').fadeToggle();
		jQuery("a.profile-realtionships-button").fadeToggle();
		
		jQuery("#relationships-list").html("<div class='alert alert-info'>Use the search box to find and relate members</div>"); // result from search are rendered
	
				
	});	
	
	jQuery(document).on('click','a.profile-realtionships-back',function(event){	
		
		jQuery('#relationshipsFormDiv').fadeToggle();
		jQuery('#profile-relationships').fadeToggle();
		jQuery("a.profile-realtionships-button").fadeToggle();
		
		jQuery("#profile-relationships").addClass("loading1");	
		ClubRegObject.listRelationships(relationshipListRequestConfig);	
	
				
	});	
	
	if(jQuery('#relationshipsFormDiv')){
		
		jQuery( document ).on('click','#search-relationships-btn',function(event){			
			
			ClubRegObject.searchRelationships(relationshipSearchRequestConfig);			
		});		
	}
	if(jQuery('#profile-relationships')){	
		
		ClubRegObject.listRelationships(relationshipListRequestConfig);	
	}	
	
	jQuery( document ).on('click','.profile-realtionships-save',function(event){		
		ClubRegObject.saveRelationships(relationshipSaveRequestConfig,jQuery(this));	
	});

});

function relationshipListRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=relationships&layout=list&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

relationshipListRequestDef.prototype.useResults = function(response){

	jQuery("#profile-relationships").removeClass("loading1");	
	jQuery("#profile-relationships").html(response);	

}
relationshipListRequestDef.prototype.rBefore = function(){
	
	jQuery("#profile-relationships").html("");	
	//jQuery("#profile-relationships").addClass("loading1");	
}

function relationshipSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&task=relationships.saverelationships&tmpl=component";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

relationshipSaveRequestDef.prototype.useResults = function(response){

	Joomla.renderMessages({message:response.msg});					

}
relationshipSaveRequestDef.prototype.useFailedResults = function(response){
	
	if(response.error){			
		Joomla.renderMessages({error:response.error});					
	}
}


function relationshipSearchRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=relationships&layout=search&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

relationshipSearchRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();	
	jQuery("#relationships-list").removeClass('loading1');
	jQuery('#relationships-list').removeClass('loading-small');
	jQuery("#relationships-list").html(response);	
}

relationshipSearchRequestDef.prototype.rBefore = function(){
	jQuery('#relationships-list').addClass('loading-small');
}



var relationshipListRequestConfig = new relationshipListRequestDef();
var relationshipSearchRequestConfig = new relationshipSearchRequestDef();
var relationshipSaveRequestConfig = new relationshipSaveRequestDef();

ClubregObjectDefinition.prototype.listRelationships = function(requestConfig){	
	
	self = this;	
	requestConfig.rData = JSON.decode(jQuery("#profile-relationships").attr('rel'));	
	self.loadAjaxRequestHTML(requestConfig);  	

}

ClubregObjectDefinition.prototype.searchRelationships = function(requestConfig){
	
	self = this;
	
	requestConfig.rData = JSON.decode(jQuery("#search-relationships-btn").attr('rel'));	
	var searchValue =  jQuery('#search-relationships-text').val();
	
	searchValue = jQuery.trim(searchValue);
	if(searchValue){
		jQuery('#relationships-list').addClass('loading1');
		jQuery('#relationshipsFormDiv').find('.control-group').removeClass('error');
		requestConfig.rData["search_value"] = searchValue;		
		self.loadAjaxRequestHTML(requestConfig);  
	}else{
		jQuery('#relationshipsFormDiv').find('.control-group').addClass('error');
	}
		
	
}

ClubregObjectDefinition.prototype.saveRelationships = function(requestConfig,linkControl){
	
	self = this;
	var parentDiv = linkControl.parents('div.profile-new-div');
	var control = parentDiv.find('select[name="relationship_value"]');
	var controlGroup = parentDiv.find('.control-group');
	var cValue = control.val()||undefined;  	
	if(cValue){
		requestConfig.rData = JSON.decode(linkControl.attr('rel'));	
		requestConfig.rData["relationship_value"] = cValue;			
		self.loadAjaxRequest(requestConfig);  
	}else{		
		controlGroup.addClass('error');
	}

	
}

function addRelationships(dObject){
	
	var json_data = JSON.decode(dObject.attr('rel'));		
	var params = "option=com_clubreg&view=relationships&layout=edit&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	
	var jqxhr = jQuery.ajax({
		url:durl,
		method:'POST',
		data:json_data
		
		})
	  .done(function(responseText) {	    
		  jQuery('#relationshipsFormDiv').removeClass('loading1');   
		  jQuery('#relationshipsFormDiv').html(responseText);	   
	    
	  })
	  .fail(function(serverResponse) {
		  profileFailureJQ(serverResponse);
	  })
	  .always(function() {
		  jQuery('#loading-div').removeClass('loading-small');
	  });
	
}