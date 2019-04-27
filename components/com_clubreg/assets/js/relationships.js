jQuery( document ).ready(function() {
	
	var relationshipsTabDivs = new renderingDivsJQ();
	var relationshipsListDiv = new divListRendererJQ();
	
	relationshipsListDiv.params = "option=com_clubreg&view=relationships&layout=list&tmpl=component&format=raw";
	
	if(jQuery('#relationshipsFormDiv')){		
		
		relationshipsTabDivs.setObjects(jQuery('#relationshipsFormDiv'),1);
		relationshipsTabDivs.setArray1(jQuery('#relationshipsFormDiv').css('margin-left'),10);		
		
		
		
	}
	if(jQuery('#profile-relationships')){	
		
		relationshipsTabDivs.setObjects(jQuery('#profile-relationships'),2);
		relationshipsTabDivs.setArray2(jQuery('#profile-relationships').css('margin-left'),profilediverightedge);		
		
		relationshipsListDiv.setDivObject(jQuery('#profile-relationships'));
		relationshipsListDiv.renderList();
	}	
	
	jQuery( document ).on('click','.profile-realtionships-button',function(event){		
		//addRelationships(jQuery(this));
		relationshipsTabDivs.toggle_div();			
		
	});
	
	jQuery( document ).on('click','#search-relationships-btn',function(event){		
		jQuery('#relationships-list').addClass('loading1');
		relationshipsTabDivs.listMembers(jQuery(this), jQuery('#search-relationships-text').val());			
	});
	

});



renderingDivsJQ.prototype.listMembers = function(dObject, search_value){
	
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