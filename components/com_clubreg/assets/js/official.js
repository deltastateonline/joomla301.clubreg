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
	
	

});



jQuery( document ).ready(function() {
	
	
	if(jQuery('#profileMembers')){	
		
		
		jQuery('#profileMembers').addClass('dashboard-div');	
		
		var json_data = JSON.decode(jQuery('#profileMembers').attr('rel'));
		
		var durl = "index.php?";	
		
		var params = "option=com_clubreg&view=ajax&layout=members&tmpl=component&format=raw";
		
		if(json_data && json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}
		
		jQuery.post(durl+params,{},function(data){			
			jQuery('#profileMembers').removeClass('loading1');			
			jQuery('#profileMembers').html(data);		
			
		},'html').fail(function(){
			jQuery('#profileMembers').removeClass('loading1');	
			jQuery('#profileMembers').html("<div class=\"alert alert-error\"><h2>"+noResults+"</h2></div>");
		});
		
		
	}
	
	
	
	
	
	if(jQuery('#profileActivity')){
		
		jQuery('#profileActivity').addClass('dashboard-div');		
		
		var json_data = JSON.decode(jQuery('#profileActivity').attr('rel'));
		
		var durl = "index.php?";	
		var params = "option=com_clubreg&view=ajax&layout=activity&tmpl=component";		
		if(json_data && json_data["Itemid"]){
			params = params + "&Itemid="+json_data["Itemid"];
		}	
		
		jQuery.post(durl+params,{},function(data){			
			jQuery('#profileActivity').removeClass('loading-small');			
			jQuery('#profileActivity').html(data);		
			
		},'html').fail(function(){
			alert("Unable to process request!");
		});
		
		
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
	}
	
	if(jQuery('#breakdownTab')){

		var params = "option=com_clubreg&view=ajax&layout=breakdown&tmpl=component&format=json&"+Joomla.formToken+"=1";		
		var durl = "index.php?"+params;	
		
		jQuery.get(durl,function(data){		
			
			if(data.proceed){	
				jQuery('#breakdownTab').removeClass('loading1');
				ClubRegObject.drawChart(data.bygroups,ClubRegObject.groupData);
				ClubRegObject.drawChart(data.bysubgroups,ClubRegObject.subGroupData);
				ClubRegObject.drawChart(data.byplayertype,ClubRegObject.playerTypeData);
			}else{
				jQuery('#breakdownTab').removeClass('loading1');
				jQuery('#breakdownTab').html(data.msg_content);		
			}	
			
		},'json').fail(function(){
			alert("Unable to process request! Generating Breakdown Charts.");
		});
	}
});