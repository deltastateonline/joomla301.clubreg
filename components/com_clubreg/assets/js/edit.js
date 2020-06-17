function editSaveRequestDef(){	
	
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
editSaveRequestDef.prototype.useResults = function(response){
	
	if(!response["proceed"]){            	
 	   render_msg(response["msg"]);
	} else{
		
		   if(response["isnew"]){
			  
			  if(response["member_key"]){
				  jQuery('#jform_member_key').val(response["member_key"]);
			  }
			  
			  if(response["member_id"]){
				 jQuery('#jform_member_id').val(response["member_id"]);  
				 jQuery('#back-to-profile').show();
				 jQuery('#back-to-list').hide();
			  }
			  
			  if(response["pk"]){            			
				 var allpks =  jQuery('input[name=pk]');            			
				 allpks.each(function(a_pk){ 
					 jQuery(allpks[a_pk]).val(response["pk"]); 
				 });
			  }
		  }            	   
		   s_or_f = 1;
		   render_msg(response["msg"]);                  
	}
	
	
}


editSaveRequestDef.prototype.useFailedResults = function(response){	
	if(response.error){		
		Joomla.renderMessages({error:response.error});					
	}
}

/** send the request **/
ClubregObjectDefinition.prototype.saveEdit= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig); 
}


var editSaveRequestConfig = new editSaveRequestDef() ;


jQuery(document).ready(function(){	
	
	if(jQuery('#jformgroup')){		
		
		group_onloadj(jQuery('#jformgroup'),jQuery('#jformgroup').val(),jQuery('#jform_playertype').val());	
		
		jQuery('#jformgroup').change( function (){			
			group_onchangej(jQuery(this),jQuery("#jformsubgroup"),-1);
		});
	}
	
	
	if(jQuery('#back-to-profile')){
		if(jQuery('#jform_member_id').val() == 0){
			jQuery('#back-to-profile').hide();
		}
	}
	if(jQuery('#back-to-list')){
		if(jQuery('#jform_member_id').val() > 0){
			jQuery('#back-to-list').hide();
		}
		
	}
	
	jQuery(document).on('submit','#edit-form',function(event){		
		
		var allButtons = jQuery(this).find('button');		
		event.preventDefault();			
		editSaveRequestConfig.rData = jQuery(this).serialize();		
		ClubRegObject.saveEdit(editSaveRequestConfig);	// request sent	
		
	});
});