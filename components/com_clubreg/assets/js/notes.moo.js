window.addEvent('domready', function () {		
	
	notesListDiv.params = "option=com_clubreg&view=note&layout=list&tmpl=component&format=raw";
	
	if($('noteFormDiv')){
		$('noteFormDiv').slide('hide').setStyle('visibility', 'visible');
	}	
	
	if($('profile-notes')){			
		notesListDiv.setDivObject($('profile-notes'));
		notesListDiv.renderList();
	}
	
	$$(".profile-note-button").addEvent('click',function(event){		
		$('jform_note_status').set('checked',false);
		$('jform_notes').set('value','');
		
		var searchSlider =  new Fx.Slide("noteFormDiv");
		searchSlider.toggle();		
	});
	
	
	if($('note-form')){
	
		$('note-form').addEvent('submit', function(event) {		
			event.stop();
			
			$('loading-div').addClass('loading-small');		
			
			new Request({
	            url: this.get("action"),
	            data: this,
	            onComplete: function() {	            	
	              
	               var json_data = JSON.decode(this.response.text);	
	               if(json_data["proceed"]){
	            	   
	            	   $('profile-notes').empty();
	            	   $('profile-notes').addClass('loading1');
	            	   
	            	   	var searchSlider =  new Fx.Slide("noteFormDiv");
	           			searchSlider.toggle();		           			
	           			notesListDiv.renderList();
	           			s_or_f = 1;
	               }	               
	               render_msg(json_data["msg"]);
	               $('loading-div').removeClass('loading-small');
	            },
	            onFailure:function(){ profileFailure(this); }
	            
	        }).send();
	
		});
		
	}
	 var container = $('profile-notes');
	 if(container){

		 container.addEvent('click:relay(.profile-private)', function(){
			 if(confirm(lockMessage)){			 
				 noteAction($(this),"ajax.locknote");		
			 }
		 });
		 
		 container.addEvent('click:relay(.profile-delete)', function(){		 
			 if(confirm(deleteMessage)){			 
				 noteAction($(this),"ajax.deletenote");
			 }		
		 });
	 }
});

var notesListDiv = new divListRenderer();


function noteAction(whichObject,whichAction){
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
					$('profile-notes').empty();
					$('profile-notes').addClass('loading1');
					notesListDiv.renderList();
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