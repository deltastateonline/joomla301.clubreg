window.addEvent('domready', function () {		
	
	attachmentsListDiv.params = "option=com_clubreg&view=attachment&layout=list&tmpl=component&format=raw";
	
	if($('attachmentFormDiv')){
		$('attachmentFormDiv').slide('hide').setStyle('visibility', 'visible');
	}	
	
	if($('profile-attachments')){			
		attachmentsListDiv.setDivObject($('profile-attachments'));
		attachmentsListDiv.renderList();		
	}
	
	$$(".profile-attachment-button").addEvent('click',function(event){		
		
		$('jform_attnotes').set('value','');
		$('jform_attachment').set('value','');		
		
		var searchSlider =  new Fx.Slide("attachmentFormDiv");
		searchSlider.toggle();		
	});
	
	
	if($('attachment-form')){
		
		var iFrame = new iFrameFormRequest('attachment-form',{
			onRequest: function(){
				 $('loading-div').addClass('loading-small');
			},
			onComplete: function(response){	
				
				var proceedData = JSON.decode(response);				
				if(proceedData["proceed"]){
					$('profile-attachments').empty();
					$('profile-attachments').addClass('loading1');
					attachmentsListDiv.renderList();					
					 s_or_f = 1;
					 render_msg(proceedData["msg"]);
					 
				}else{
					var msg_text  = "";					
					if(proceedData["msg"]){ 						
						render_msg(proceedData["msg"]);
					}else{
						msg_text = "Unable to complete action";
						render_msg(msg_text);
					}
				}			
			},
            onFailure:function(){ profileFailure(this); }
		});
	
		
	}
	 var container = $('profile-attachments');
	 if(container){	
		 
		 container.addEvent('click:relay(.profile-attach-delete)', function(){		 
			 if(confirm(deleteMessage)){				
				 attachmentAction($(this),"ajax.deleteattachment");
			 }		
		 });
		 container.addEvent('click:relay(.profile-attach-private)', function(){		 
			 if(confirm(lockMessage)){			 
				 attachmentAction($(this),"ajax.lockattachment");
			 }		
		 });
		 
		 
		 container.addEvent('click:relay(.profile-attach-content-btn)', function(){
			 
			 var json_data = JSON.decode(this.get('rel'));			 
			 var attach_content =  new Fx.Slide("profile-attach-"+json_data['content_key']);
			 attach_content.toggle();			
			 
		 });		 
			 
	 }
});

var attachmentsListDiv = new divListRenderer();


function attachmentAction(whichObject,whichAction){
	 var json_data = JSON.decode(whichObject.get('rel'));	
	 json_data[token]=1;
	 $('loading-div').addClass('loading-small');
	 
	 var params = "option=com_clubreg&task="+whichAction+"&tmpl=component";		
	 var durl = "index.php?"+params;
	 var a = new Request({
		url : durl, 
		method: 'post',	
		data : json_data,
		onSuccess: function(responseText){ 
				var proceedData = JSON.decode(responseText);				
				if(proceedData["proceed"]){
					$('profile-attachments').empty();
					$('profile-attachments').addClass('loading1');
					attachmentsListDiv.renderList();
					 s_or_f = 1;
					 render_msg(proceedData["msg"]);
				}else{
					if(proceedData["msg"]){render_msg(proceedData["msg"]);}else{
						render_msg("Unable to complete action");
					}
				}
				$('loading-div').removeClass('loading-small');
		},
		onFailure:function(){ profileFailure(this); }
		}).send();
	
}