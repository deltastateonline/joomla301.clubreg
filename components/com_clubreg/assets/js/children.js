window.addEvent('domready', function () {	
	
	var childrenTabDivs = new renderingDivs();
	var childrenListDiv = new divListRenderer();
	
	childrenListDiv.params = "option=com_clubreg&view=children&layout=list&tmpl=component&format=raw";
	
	if($('childrenFormDiv')){			
		childrenTabDivs.setObjects(new Fx.Morph($('childrenFormDiv')),1);
		childrenTabDivs.setArray1($('childrenFormDiv').getStyle('margin-left'),10);		
	}
	if($('profile-children')){		
		childrenTabDivs.setObjects(new Fx.Morph($('profile-children')),2);
		childrenTabDivs.setArray2($('profile-children').getStyle('margin-left'),profilediverightedge);			
		
		childrenListDiv.setDivObject($('profile-children'));
		childrenListDiv.renderList();
	}
	
	$$(".profile-children-button").addEvent('click',function(event){		
		if(childrenTabDivs.inOut){ 
			$('childrenFormDiv').empty();
			$('childrenFormDiv').addClass('loading1');			
			editChildren($('childrenFormDiv'));
		}		
		childrenTabDivs.toggle_div();
	});
	
	var container = $('childrenFormDiv');
	
	if(container){
	
		container.addEvent("submit:relay($('edit-form'))", function(event){
			
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
	            	   	$('profile-children').empty();
	       				$('profile-children').addClass('loading1');       				
	       				childrenListDiv.renderList();
	       				childrenTabDivs.toggle_div();	
	       				s_or_f = 1;
	       				render_msg(json_data["msg"]);
	               }              
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();
	
		});
		
	
			container.addEvent("change:relay($('jformgroup'))", function (){					
				if($(this).id == 'jformgroup'){
					group_onchange($('jformgroup'),$("jformsubgroup"),-1);
				}
			});
			
			//back button
			container.addEvent("click:relay($('toggle-children-div'))", function(event){			
				if($(this).id == "toggle-children-div"){
					childrenTabDivs.toggle_div();
				}
			});
		
	}
	
	 var container = $('profile-children');
	 if(container){
		 container.addEvent('click:relay(.profile-children-button)', function(){ // click event on link
			 $('childrenFormDiv').empty();
			 $('childrenFormDiv').addClass('loading1');
			 editChildren($(this));
			 childrenTabDivs.toggle_div();		
		 });			 
		
	 }
	 
	
	
});


function editChildren(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=regmember&layout=edit&tmpl=component";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('childrenFormDiv'),
		onSuccess: function(responseText){ $('childrenFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');}
		}).send();	
	
}