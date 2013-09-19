
	var guardianTabDivs = new renderingDivs();
	var guardianListDiv = new divListRenderer();
	
window.addEvent('domready', function () {	

	guardianListDiv.params = "option=com_clubreg&view=guardian&layout=details&tmpl=component&format=raw";	
	
	if($('guardianFormDiv')){			
		guardianTabDivs.setObjects(new Fx.Morph($('guardianFormDiv')),1);
		guardianTabDivs.setArray1($('guardianFormDiv').getStyle('margin-left'),10);	
		
	}
	if($('profile-guardian')){		
		guardianTabDivs.setObjects(new Fx.Morph($('profile-guardian')),2);
		guardianTabDivs.setArray2($('profile-guardian').getStyle('margin-left'),profilediverightedge);	
		
		$('profile-guardian').addClass('loading1');
		guardianListDiv.setDivObject($('profile-guardian'));
		guardianListDiv.renderList();
	}
	
	$$(".profile-guardian-button").addEvent('click',function(event){		
		if(guardianTabDivs.inOut){
			// need to reset the control, simply searh again
			//$('guardian-list').empty();
		//	$('guardianFormDiv').addClass('loading1');	
			//listGuardian(dObject, search_value);
		}		
		guardianTabDivs.toggle_div();
	});
	
	var container = $('guardianFormDiv');
	
	if(container){
	
		container.addEvent("submit:relay($('guardian-form'))", function(event){
			
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
	            	    s_or_f = 1;
	       				render_msg(json_data["msg"]);
	            	   	$('profile-guardian').empty();
	       				$('profile-guardian').addClass('loading1');       				
	       				guardianListDiv.renderList();  
	       				guardianTabDivs.toggle_div();
	       				
	               }              
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();
	
		});	
		
		container.addEvent("click:relay($('toggle-guardian-div'))", function(event){			
			if($(this).id == "toggle-guardian-div"){
				guardianTabDivs.toggle_div();
			}
		});
		
		container.addEvent("click:relay($('search-guardian-btn'))", function(event){			
			if($(this).id == "search-guardian-btn"){	
				$('guardian-list').addClass('loading1');
				listGuardian($(this), $('search-guardian-text').value);				
			}
		});
			
			container.addEvent("click:relay($(this))", function(event){	
				event.stop();				
				var var_class = $(this).get('class');
				if(var_class.test('re-assign-guardian')){	
					guardian_assign($(this));
				}
			});
	}
	
});

function listGuardian(dObject, search_value){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=guardian&layout=list&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	json_data["search_value"] = search_value;
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('guardian-list'),
		onSuccess: function(responseText){ $('guardian-list').removeClass('loading1');$('guardianFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');}
		}).send();	
	
}
function guardian_assign(dObject){

	
	var json_data = JSON.decode(dObject.get('rel'));	
	var params = "option=com_clubreg&task=ajax.assignguardian";		
	var durl = "index.php?"+params;	
	
	new Request({
        url: durl,
        data: json_data,
        onComplete: function() {
    	 
           var json_data = JSON.decode(this.response.text);	
           if(!json_data["proceed"]){            	
        	   render_msg(json_data["msg"]);
           } else{
        	   s_or_f = 1;
  				render_msg(json_data["msg"]);
        	 	$('profile-guardian').empty();
   				$('profile-guardian').addClass('loading1');       				
   				guardianListDiv.renderList();  
   				guardianTabDivs.toggle_div();
           }
           $('loading-div').removeClass('loading-small');
        }
    }).send();
}
