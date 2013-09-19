window.addEvent('domready', function () {	
	
	var propertyTabDivs = new renderingDivs();
	var propertyListDiv = new divListRenderer();
	
	
	propertyListDiv.params = "option=com_clubreg&view=property&layout=list&tmpl=component&format=raw";
	
	if($('propertyFormDiv')){		
		propertyTabDivs.setObjects(new Fx.Morph($('propertyFormDiv')),1);
		propertyTabDivs.setArray1($('propertyFormDiv').getStyle('margin-left'),10);	
	}
	if($('profile-propertys')){		
		propertyTabDivs.setObjects(new Fx.Morph($('profile-propertys')),2);
		propertyTabDivs.setArray2($('profile-propertys').getStyle('margin-left'),profilediverightedge);		
		
		propertyListDiv.setDivObject($('profile-propertys'));
		propertyListDiv.renderList();
	}	
	
	$$(".profile-property-button").addEvent('click',function(event){	
		
		if(propertyTabDivs.inOut){ 
			$('propertyFormDiv').empty();
			$('propertyFormDiv').addClass('loading1');
			addProperty($(this));
		}		
		propertyTabDivs.toggle_div();		
	});
	
	var container = $('propertyFormDiv');
	
	if(container){
		
		container.addEvent("submit:relay($('property-form'))", function(event){
			
			event.stop();
			
			$('loading-div').addClass('loading-small');		
			
			new Request({
	            url: this.get("action"),
	            data: this,
	            onComplete: function() {
	              
	               var json_data = JSON.decode(this.response.text);	
	               if(!json_data["proceed"]){            	
	            	   render_msg(json_data["msg"]);
	               }else{
		               if(json_data["isNew"]){
		            	   s_or_f = 1;
		            	   render_msg(json_data["msg"]);
		            	   $('profile-propertys').empty();
		            	   $('profile-propertys').addClass('loading1');
		            	   propertyListDiv.renderList();
		            	   propertyTabDivs.toggle_div();	
		               }else{
		            	   s_or_f = 1;
		            	   render_msg(json_data["msg"]);
		            	   propertyTabDivs.toggle_div();
		            	   load_property(json_data["property_id"]);
		               }
	               }
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();			
	
		});	
		
		container.addEvent("click:relay($('toggle-propertys-div'))", function(event){			
			if($(this).id == "toggle-propertys-div"){
				propertyTabDivs.toggle_div();
			}
		});
	
		
		 var container = $('profile-propertys'); // after an item has been added we should still able to edit it
		 if(container){
			 container.addEvent('click:relay(.profile-property-button)', function(){ // click event on link
				 $('propertyFormDiv').empty();
				 $('propertyFormDiv').addClass('loading1');
				 addProperty($(this));
				 propertyTabDivs.toggle_div();	
			 });			
		 }	
	}
	
});

function addProperty(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=property&layout=edit&tmpl=component";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('propertyFormDiv'),
		onSuccess: function(responseText){ $('propertyFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');},
		onFailure:function(){ profileFailure(this);	}
		}).send();	
	
}

function load_property(property_id){
	var wDiv = $('propertydata_'+property_id);
	
	wDiv.empty();	
	wDiv.addClass('loading1');
	
	var json_data = JSON.decode(wDiv.get('rel'));		
	var params = "option=com_clubreg&view=property&layout=detail&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',		
		update: wDiv,
		data : json_data,
		onSuccess: function(responseText){ wDiv.removeClass('loading1')},
		onFailure:function(){ profileFailure(this); }
		}).send();
}