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
	self.rUrl  =  "index.php?option=com_clubreg&view=note&layout=list&tmpl=component&format=raw";
	self.rMethod  = "post";
	self.rData  = {}	;	
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
	jQuery("a.profile-note-button" ).trigger( "click" );
	ClubRegObject.listNotes(notesListRequestConfig);
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
	render_msg(response.msg); // renxder messages
	ClubRegObject.listNotes(notesListRequestConfig);	// render list
};

noteProcessRequestDef.prototype.useFailedResults = function(response){	
	render_msg(response.errors);
}


var notesListRequestConfig = new notesListRequestDef();
var noteSaveRequestConfig = new noteSaveRequestDef();
var noteProcessRequestConfig = new noteProcessRequestDef();

ClubregObjectDefinition.prototype.listNotes= function(requestConfig){	
	self = this;	
	requestConfig.rData = JSON.decode(jQuery("#profile-notes").attr('rel'));	
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