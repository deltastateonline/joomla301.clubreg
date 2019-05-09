jQuery( document ).ready(function() {
	
	jQuery('#relationshipsFormDiv').fadeOut();
	
	jQuery(document).on('click','a.profile-realtionships-button, a.profile-realtionships-link',function(event){	
		
		jQuery('#relationshipsFormDiv').fadeToggle();
		jQuery('#profile-relationships').fadeToggle();
		jQuery("a.profile-realtionships-button").fadeToggle();
	
				
	});	


	
	//relationshipsListDiv.params = "option=com_clubreg&view=relationships&layout=list&tmpl=component&format=raw";
	
	if(jQuery('#relationshipsFormDiv')){
		
		jQuery( document ).on('click','#search-relationships-btn',function(event){			
			
			ClubRegObject.searchRelationships(relationshipSearchRequestConfig);			
		});		
	}
	if(jQuery('#profile-relationships')){	
		
		/*relationshipsTabDivs.setObjects(jQuery('#profile-relationships'),2);
		relationshipsTabDivs.setArray2(jQuery('#profile-relationships').css('margin-left'),profilediverightedge);		
		
		relationshipsListDiv.setDivObject(jQuery('#profile-relationships'));*/
		ClubRegObject.listRelationships(relationshipListRequestConfig);	
	}	
	
	jQuery( document ).on('click','.profile-realtionships-save',function(event){		
		//addRelationships(jQuery(this));
		//relationshipsTabDivs.toggle_div();			
		ClubRegObject.saveRelationships(relationshipSaveRequestConfig,jQuery(this));	
	});
	

	

});

function relationshipListRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=relationships&layout=profiles&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

function relationshipSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&task=relationships.saverelationships&tmpl=component";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

function relationshipSearchRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php?option=com_clubreg&view=relationships&layout=search&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

relationshipSearchRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();	
	jQuery("#relationships-list").removeClass('loading1');
	jQuery("#relationships-list").html(response);	
}



var relationshipListRequestConfig = new relationshipListRequestDef();
var relationshipSearchRequestConfig = new relationshipSearchRequestDef();
var relationshipSaveRequestConfig = new relationshipSaveRequestDef();

ClubregObjectDefinition.prototype.listRelationships = function(requestConfig){
	
	
	self = this;
	console.log(requestConfig);
	/*
	
	
	var json_data = JSON.decode(dObject.attr('rel'));		
	var params = "option=com_clubreg&view=relationships&layout=profiles&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	json_data["search_value"] = search_value;
	
	
	var jqxhr = jQuery.ajax({
		url:durl,
		method:'POST',
		data:json_data
		
		})
	  .done(function(responseText) {	    
		  jQuery('#relationships-list').removeClass('loading1');   
		  jQuery('#relationships-list').html(responseText);	   
	    
	  })
	  .fail(function(serverResponse) {
		  profileFailureJQ(serverResponse);
	  })
	  .always(function() {
		  jQuery('#loading-div').removeClass('loading-small');
	  });
	*/
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
	var cValue = control.val()||undefined;  //trim();	
	if(cValue){
		requestConfig.rData = JSON.decode(linkControl.attr('rel'));	
		requestConfig.rData["relationship_value"] = cValue;		
		console.log(requestConfig);
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