function group_onload(group_control,c_selection,group_type){
	
	var postData = new Object();
	postData['group_type'] = group_type;
	postData[token] = 1;
	var params = "option=com_clubreg&view=ajax&layout=mygroups&tmpl=component&format=json";		
	var durl = "index.php?"+params;	
	
	var jsonData = JSON.encode(postData);	
	
	new Request({
        url: durl,
        data: JSON.decode(jsonData),
        onRequest : group_onrequest(group_control),
        onComplete: function(responseText){ group_oncompletion(responseText,group_control,c_selection);},
        onFailure:function(){ profileFailure(this); }        
    }).send();
	
}

/**
 * 
 * @param group_control
 * @param subgroup_control
 * @param c_selection
 */

function group_onchange(group_control,subgroup_control,c_selection){
	
	var postData = new Object();
	postData["group_id"] = group_control.get('value');
	postData[token] = 1;
	var params = "option=com_clubreg&view=ajax&layout=subgroups&tmpl=component&format=json";		
	var durl = "index.php?"+params;	
	
	var jsonData = JSON.encode(postData);	
	
	new Request({
        url: durl,
        data: JSON.decode(jsonData),
        onRequest : group_onrequest(subgroup_control),
        onComplete: function(responseText){ group_oncompletion(responseText,subgroup_control,c_selection);},
        onFailure:function(){ profileFailure(this); }        
    }).send();
	
}
function group_oncompletion(responseText,subgroup_control,c_selection ){

	var subgroup_data = JSON.decode(responseText);		
	subgroup_control.empty();

	subgroup_data.each(function(item){ 	
		
		var newoption = new Option(item['text'],item['value'] );	
		if(c_selection == item['value']){ newoption.selected = true;}
		subgroup_control.add(newoption);					
	});
	
}
function group_onrequest(group_control){
	
	group_control.empty();
	var newoption = new Option('- Loading Please Wait -','-1' );				
	group_control.add(newoption);	
	
}


var jQueryClubregGroups = {
	
	onRequest:function(group_control){
		group_control.empty();
		var newoption = new Option('- Loading Please Wait -','-1' );				
		group_control.append(newoption);			
	},
	
	onCompletion: function(response,group_control,c_selection){		
		group_control.empty();
		response.each(function(item){ 		
			
			var newoption = new Option(item['text'],item['value'] );	
			if(c_selection == item['value']){ newoption.selected = true;}
			group_control.append(newoption);					
		});
		
	}
	
	
};


function profileFailure(rObject){	
	$('loading-div').removeClass('loading-small');
	alert(rObject.getHeader('Status'));	
}


function group_onloadj(group_control,c_selection,group_type){	
	
	var postData = new Object();
	postData['group_type'] = group_type;
	postData[token] = 1;
	var params = "option=com_clubreg&view=ajax&layout=mygroups&tmpl=component&format=json";		
	var durl = "index.php?"+params;		
	
	jQuery.ajax({
		url: durl,
		type: "POST",
		dataType: 'json',
		cache: false,
		data:postData,
		beforeSend:function(){jQueryClubregGroups.onRequest(group_control);},		
		success: function( response, textStatus, XMLHttpRequest ) {			
			jQueryClubregGroups.onCompletion(response,group_control,c_selection);
		},
		error: function( XMLHttpRequest, textStatus, errorThrown ) {
			
		}
	});
}

/**
 * 
 * @param group_control
 * @param subgroup_control
 * @param c_selection
 */

function group_onchangej(group_control,subgroup_control,c_selection){
	
	
	var postData = new Object();
	postData["group_id"] = group_control.val();
	postData[token] = 1;
	var params = "option=com_clubreg&view=ajax&layout=subgroups&tmpl=component&format=json";		
	var durl = "index.php?"+params;	
	
	jQuery.ajax({
		url: durl,
		type: "POST",
		dataType: 'json',
		cache: false,
		data:postData,
		beforeSend:function(){jQueryClubregGroups.onRequest(subgroup_control);},		
		success: function( response, textStatus, XMLHttpRequest ) {			
			jQueryClubregGroups.onCompletion(response,subgroup_control,c_selection);
		},
		error: function( XMLHttpRequest, textStatus, errorThrown ) {
			
		}
	});	
}



