window.addEvent('domready', function () {	
	
	
	if($('profileEoi')){
				
		$('profileEoi').addClass('dashboard-div');	
		
		var json_data = JSON.decode($('profileEoi').get('rel'));		
		
		var durl = "index.php";	
		
		var params = "option=com_clubreg&view=ajax&layout=eoi&tmpl=component";
		
		if(json_data && json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}
		var a = new Request.HTML({ 
			url : durl, 
			method: 'get',	
			update: $('profileEoi'),
			onSuccess: function(responseText){ $('profileEoi').removeClass('loading1');	}
			}).send(params);
		
	}
	
	if($('profileActivity')){
			
		$('profileActivity').addClass('dashboard-div');		
		
		var json_data = JSON.decode($('profileActivity').get('rel'));
		
		var durl = "index.php";	
		var params = "option=com_clubreg&view=ajax&layout=activity&tmpl=component";		
		if(json_data && json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}
		var req = new Request.HTML({
			method: 'get',
			url: durl,			
			//onRequest: function() { alert('Request made. Please wait...'); },
			update: $('profileActivity'),
			onComplete: function(response) { $('profileActivity').removeClass('loading1'); 	}
		}).send(params);
		
		
		var container = $('profileActivity');
		
		container.addEvent("click:relay($(this))", function(event){	
			//event.stop();				
			var var_class = $(this).get('class');
			
			if(var_class != null &&  var_class.test('activity-item')){			
				renderActivity($(this));
			}
		});
		
	}
	
	if($('profileBirthday')){
		
		$('profileBirthday').addClass('dashboard-div');	
		
		var json_data = JSON.decode($('profileBirthday').get('rel'));
		
		var durl = "index.php";	
		
		var params = "option=com_clubreg&view=ajax&layout=bday&tmpl=component&format=raw";
		
		if(json_data && json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}
		var a = new Request.HTML({ 
			url : durl, 
			method: 'get',	
			update: $('profileBirthday'),
			onSuccess: function(responseText){ $('profileBirthday').removeClass('loading1');	}
			}).send(params);
		
	}
	
	
	if($('profileMembers')){
			
			$('profileMembers').addClass('dashboard-div');	
			
			var json_data = JSON.decode($('profileMembers').get('rel'));
			
			var durl = "index.php";	
			
			var params = "option=com_clubreg&view=ajax&layout=members&tmpl=component&format=raw";
			
			if(json_data && json_data["Itemid"]){
				params = params + "&Itemid="+json_data["Itemid"];
			}
			var a = new Request.HTML({ 
				url : durl, 
				method: 'get',	
				update: $('profileMembers'),
				onSuccess: function(responseText){ $('profileMembers').removeClass('loading1');	}
				}).send(params);
			
		}
});

function renderActivity(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=anactivity&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: dObject,
		onRequest : function(){dObject.empty();dObject.addClass('loading-small');},
		onSuccess: function(responseText){ dObject.removeClass('loading-small'); dObject.removeClass('activity-item');}
		}).send();	
	
}

jQuery( document ).ready(function() {
	
	jQuery("#profileActivity").on('click',".img_hidden",function(event){		
		
		var post_data = JSON.decode(jQuery(this).attr("rel"));	
		
		var contentHere = jQuery(this).parents(".content-here");
		
		var params = "option=com_clubreg&view=ajax&layout=anactivity&tmpl=component&format=raw";		
		var durl = "index.php?"+params;	
		
		contentHere.addClass('loading-small');
		jQuery.post(durl,post_data,function(data){			
			contentHere.removeClass('loading-small');			
			contentHere.html(data);		
			
		},'html').fail(function(){
			alert("Unable to process request!");
		});
	
	});
});