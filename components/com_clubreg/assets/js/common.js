var renderingDivs = new Class({
	
	inOut : 1,
	m1_array : new Array(),
	m2_array : new Array(),
	morphObject : new Object(),
	morphObject2 : new Object(),
	
	toggle_div: function(){
		
		this.morphObject2.start({
			'margin-left': this.m2_array[this.inOut],				
		});
		this.morphObject.start({
			'margin-left': this.m1_array[this.inOut],				
		});		
		this.inOut = 1- this.inOut;		
	},
	
	setObjects: function(morphObject,whichObject){
		if(whichObject == 1){
			this.morphObject = morphObject;
		}
		if(whichObject == 2){
			this.morphObject2 = morphObject;
		}
	},
	setArray1:function(v1,v2){
		this.m1_array[0] = v1;
		this.m1_array[1] = v2;
	},	
	setArray2:function(v1,v2){
		this.m2_array[0] = v1;
		this.m2_array[1] = v2;
	}
	
});

var divListRenderer = new Class({
	
	listDiv : new Object(),
	params : "",
	
	setDivObject:function(divObject){
		this.listDiv = divObject;
	},
	
	renderList:function(){
		
		var json_data = JSON.decode(this.listDiv.get('rel'));		
		var durl = "index.php";
		var current_div = this.listDiv;
		
		var t_strings = this.params.split("&");		
		var t_length = t_strings.length;
		
		for(var i = 0; i < t_length; i++){
			var b = t_strings[i].split('=');			
			json_data[decodeURIComponent(b[0])] = decodeURIComponent(b[1]);			
		}	
		
		
		var a = new Request.HTML({
			url : durl, 
			method: 'post',	
			data : json_data,
			update: current_div,
			onSuccess: function(responseText){ current_div.removeClass('loading1');$('loading-div').removeClass('loading-small');},
			onFailure:function(){ profileFailure(this); }		
			}).send();
	}
	
});

function profileFailure(rObject){	
	$('loading-div').removeClass('loading-small');	
	if(rObject.getHeader('Status'))
		error_msg = rObject.getHeader('Status')
	else
		error_msg = "Error has occured";
		
		render_msg(error_msg);
}
var s_or_f = 0; // success or failure flag
var alert_style = "";
function render_msg(msg_text){
	
	final_string = "";
	
	if(typeof msg_text === 'string'){
		final_string = msg_text;
	}else{
		var msg_count = msg_text.length;
		for(var i = 0; i < msg_count; i++ ){
			final_string += msg_text[i]+"<br />";
		}
	}
	
	
	$('loading-div').removeClass('loading-small');	
	$('loading-div').set('html',final_string);
	
	if(s_or_f == 1){
		alert_style = ' alert-success';	
	}else{	
		alert_style = ' alert-error';	
	}
	s_or_f = 0;
	$('loading-div').addClass('alert'+alert_style);	 
	$('loading-div').set('tween', {duration: 6000,
		
	    onComplete: function(){
	        // Run function on complete
	    	$('loading-div').set('html','');
	    	
	    	$('loading-div').removeClass('alert'+alert_style);	 
	    	$('loading-div').set('tween',{duration:10}).fade('in');
	    }		
	}).fade('out');	
}
