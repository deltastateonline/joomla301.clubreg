window.addEvent('domready', function () {		
	
	attachmentsListDiv.params = "option=com_clubreg&view=ajax&layout=attachments&tmpl=component";
	
	if($('attachmentFormDiv')){
		$('attachmentFormDiv').slide('hide').setStyle('visibility', 'visible');
	}	
	
	if($('profile-attachments')){			
		attachmentsListDiv.setDivObject($('profile-attachments'));
		attachmentsListDiv.renderList();
	}
	
	$$(".profile-attachment-button").addEvent('click',function(event){		
		
		$('jform_notes').set('value','');
		
		var searchSlider =  new Fx.Slide("attachmentFormDiv");
		searchSlider.toggle();		
	});
	
	
	if($('attachment-form')){
		
		var iFrame = new iFrameFormRequest('attachment-form',{
			onRequest: function(){
				document.id('profile-attachments').set('text','start');
			},
			onComplete: function(response){
				document.id('profile-attachments').set('html',response);
			}
		});
	/*
		$('attachment-form').addEvent('submit', function(event) {		
			event.stop();
			
			$('loading-div').addClass('loading-small');		
			
			new Request({
	            url: this.get("action"),
	            data: this,
	            onComplete: function() {	            	
	              
	               var json_data = JSON.decode(this.response.text);	
	               if(json_data["proceed"]){
	            	   
	            	   $('profile-attachments').empty();
	            	   $('profile-attachments').addClass('loading1');
	            	   
	            	   /*	var searchSlider =  new Fx.Slide("attachmentFormDiv");
	           			searchSlider.toggle();		           			
	           			attachmentsListDiv.renderList();
	           			
	               }
	               $('loading-div').removeClass('loading-small');
	            },
	            onFailure:function(){ profileFailure(this); }
	            
	        }).send();
	
		});*/
		
	}
	 var container = $('profile-attachments');
	 if(container){

		 container.addEvent('click:relay(.profile-private)', function(){
			 if(confirm(lockMessage)){			 
				// noteAction($(this),"ajax.locknote");		
			 }
		 });
		 
		 container.addEvent('click:relay(.profile-delete)', function(){		 
			 if(confirm(deleteMessage)){			 
				// noteAction($(this),"ajax.deletenote");
			 }		
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
				}else{
					if(proceedData["msg"]){alert(proceedData["msg"]);}else{
						alert("Unable to complete action");
					}
				}
				$('loading-div').removeClass('loading-small');
		},
		onFailure:function(){ profileFailure(this); }
		}).send();
	
}