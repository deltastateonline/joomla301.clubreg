window.addEvent('domready', function () {	
	
	var otherTabDivs = new renderingDivs();
	var otherListDiv = new divListRenderer();
	
	otherListDiv.params = "option=com_clubreg&view=other&layout=list&tmpl=component&format=raw";
	
	if($('otherFormDiv')){		
		otherTabDivs.setObjects(new Fx.Morph($('otherFormDiv')),1);
		otherTabDivs.setArray1($('otherFormDiv').getStyle('margin-left'),10);			
	}
	if($('profile-other')){			
		otherTabDivs.setObjects(new Fx.Morph($('profile-other')),2);
		otherTabDivs.setArray2($('profile-other').getStyle('margin-left'),profilediverightedge);			
		
		otherListDiv.setDivObject($('profile-other'));
		otherListDiv.renderList();
	}
	
	$$(".profile-other-button").addEvent('click',function(event){		
		if(otherTabDivs.inOut){ 
			$('otherFormDiv').empty();
			$('otherFormDiv').addClass('loading1');			
			editOther($('otherFormDiv'));
		}		
		otherTabDivs.toggle_div();		
	});
	
	var container = $('otherFormDiv');
	
	if(container){
	
		container.addEvent("submit:relay($('other-form'))", function(event){
			
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
	            	   	$('profile-other').empty();
	       				$('profile-other').addClass('loading1');       				
	       				otherListDiv.renderList();
	       				otherTabDivs.toggle_div();
	       				s_or_f = 1;
	       				render_msg(json_data["msg"]);
	               }              
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();
	
		});	
		
		container.addEvent("click:relay($('toggle-other-div'))", function(event){			
			if($(this).id == "toggle-other-div"){
				otherTabDivs.toggle_div();
			}
		});
	}
	
});

function editOther(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=other&layout=edit&tmpl=component";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('otherFormDiv'),
		onSuccess: function(responseText){ $('otherFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');}
		}).send();	
	
}