window.addEvent('domready', function () {	
	
	var emergencyTabDivs = new renderingDivs();
	var emergencyListDiv = new divListRenderer();
	
	emergencyListDiv.params = "option=com_clubreg&view=ajax&layout=aemergency&tmpl=component&format=raw";
	
	
	if($('emergencyFormDiv')){			
		emergencyTabDivs.setObjects(new Fx.Morph($('emergencyFormDiv')),1);
		emergencyTabDivs.setArray1($('emergencyFormDiv').getStyle('margin-left'),10);			
	}
	if($('profile-emergency')){		
		emergencyTabDivs.setObjects(new Fx.Morph($('profile-emergency')),2);
		emergencyTabDivs.setArray2($('profile-emergency').getStyle('margin-left'),profilediverightedge);	
		
		emergencyListDiv.setDivObject($('profile-emergency'));
		emergencyListDiv.renderList();
	}
	
	$$(".profile-emergency-button").addEvent('click',function(event){		
		if(emergencyTabDivs.inOut){ 
			$('emergencyFormDiv').empty();
			$('emergencyFormDiv').addClass('loading1');			
			editEmergency($('emergencyFormDiv'));
		}		
		emergencyTabDivs.toggle_div();
	});
	
	var container = $('emergencyFormDiv');
	
	if(container){
	
		container.addEvent("submit:relay($('emergency-form'))", function(event){
			
			event.stop();
			
			$('loading-div').addClass('loading-small');		
			
			new Request({
	            url: this.get("action"),
	            data: this,
	            onComplete: function() {
	              
	               var json_data = JSON.decode(this.response.text);	
	               if(!json_data["proceed"]){            	
	            	   render_msg(json_data["msg"]);
	               } else{
	            	   	$('profile-emergency').empty();
	       				$('profile-emergency').addClass('loading1');       				
	       				emergencyListDiv.renderList();  
	       				emergencyTabDivs.toggle_div();
	       				s_or_f = 1;
	       				render_msg(json_data["msg"]);
	               }              
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();
	
		});	
		
		container.addEvent("click:relay($('toggle-emergency-div'))", function(event){			
			if($(this).id == "toggle-emergency-div"){
				emergencyTabDivs.toggle_div();
			}
		});
	}
	
});


function editEmergency(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=emergency&tmpl=component";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('emergencyFormDiv'),
		onSuccess: function(responseText){ $('emergencyFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');}
		}).send();	
	
}