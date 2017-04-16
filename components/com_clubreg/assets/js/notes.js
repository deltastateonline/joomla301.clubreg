/**
 * Need to watch out for the click
 */
jQuery( document ).ready(function() {

	jQuery('#noteFormDiv').fadeOut();	
	
	jQuery(document).on('click','a.profile-note-button',function(event){
		
		jQuery('#noteFormDiv').fadeToggle();
		jQuery('#profile-notes').fadeToggle();
		jQuery("a.profile-note-button").fadeToggle();
						
	});
	
	jQuery(document).on('click','button.profile-note-button-cancel',function(event){		
		
		jQuery('#noteFormDiv').fadeToggle();
		jQuery('#profile-notes').fadeToggle();
		jQuery("a.profile-note-button").fadeToggle();
	
	});	
	
	
	jQuery(document).on('submit','#note-form',function(event){	
		
		event.preventDefault();			
		noteSaveRequestConfig.rData = jQuery(this).serialize();
		ClubRegObject.saveNote(noteSaveRequestConfig);	
		
	});
	
	jQuery(document).on('click','a.profile-delete',function(event){		
		 if(confirm(deleteMessage)){
			ClubRegObject.processNote(noteProcessRequestConfig,jQuery(this),"ajax.deletenote");
		}		
	});	
	
	jQuery(document).on('click','a.profile-private',function(event){		
		 if(confirm(lockMessage)){
			ClubRegObject.processNote(noteProcessRequestConfig,jQuery(this),"ajax.locknote");
		}		
	});	
	ClubRegObject.listNotes(notesListRequestConfig);
});

/**
 * Config Request for listing notes
 */
function notesListRequestDef(){	
	
	self = this;
	//self.rUrl  =  "index.php?option=com_clubreg&view=note&layout=list&tmpl=component&format=raw";
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {"option":"com_clubreg","view":"note","layout":"list","tmpl":"component","format":"raw"};	
};
notesListRequestDef.prototype.useResults  = function(response){	
	jQuery("#profile-notes").removeClass('loading1');
	jQuery("#profile-notes").html(response);
}

/**
 * Config for saving notes
 */
function noteSaveRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {}	;	
	
	self.rBefore = beforeAction;
};

noteSaveRequestDef.prototype.useResults  = function(response){		
	s_or_f = 1;
	render_msg(response.msg);
	
	jQuery("#noteFormDiv #jform_notes" ).val(""); // set the value to null 
	jQuery("#noteFormDiv #jform_note_status" ).attr('checked',false); // set the value to null 
	
	
	jQuery("a.profile-note-button" ).trigger( "click" ); // trigger a click to hide the form
	ClubRegObject.listNotes(notesListRequestConfig); // try lis the notes again
}


/**
 * Config for processing notes
 */
function noteProcessRequestDef(){	
		 
	self = this;
	self.rUrl  =  null;
	self.rMethod  = "post";
	self.rData  = {}	;	
	self.rBefore = beforeAction ;
};

noteProcessRequestDef.prototype.useResults  = function(response){
	s_or_f = 1;
	render_msg(response.msg); // renxder messages
	
	ClubRegObject.listNotes(notesListRequestConfig);	// render list
};


var notesListRequestConfig = jQuery.extend(new notesListRequestDef(),failedResponse) ;
var noteSaveRequestConfig = jQuery.extend(new noteSaveRequestDef(),failedResponse) ;
var noteProcessRequestConfig = jQuery.extend( new noteProcessRequestDef(),failedResponse) ;

ClubregObjectDefinition.prototype.listNotes= function(requestConfig){	
	self = this;	
	jQuery.extend(requestConfig.rData, JSON.decode(jQuery("#profile-notes").attr('rel')));
	self.loadAjaxRequestHTML(requestConfig);  
}

ClubregObjectDefinition.prototype.saveNote= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig);  
}

ClubregObjectDefinition.prototype.processNote= function(requestConfig,whichObject,whichAction){	
	self = this;	
	
	 var params = "option=com_clubreg&task="+whichAction+"&tmpl=component";		
	 requestConfig.rUrl =  "index.php?"+params;
	 
	 var json_data = JSON.decode(whichObject.attr('rel'));	
	 json_data[token]=1; 
	 
	requestConfig.rData = json_data;
	self.loadAjaxRequest(requestConfig);  
}