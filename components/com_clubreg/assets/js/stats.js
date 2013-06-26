window.addEvent('domready', function () {	
	
	if($('statsFormDiv')){			
		morphObject_stats = new Fx.Morph($('statsFormDiv'));
		m1_array_stats[0] =  $('statsFormDiv').getStyle('margin-left');
		m1_array_stats[1] = 10;
		
	}
	if($('profile-stats')){		
		morphObject2_stats = new Fx.Morph($('profile-stats'));	
		m2_array_stats[0]  = $('profile-stats').getStyle('margin-left');	
		m2_array_stats[1] = profilediverightedge;
		
		renderStats();
	}
	
	$$(".profile-stats-button").addEvent('click',function(event){		
		if(inOut_stats){ 
			$('statsFormDiv').empty();
			$('statsFormDiv').addClass('loading1');			
			//editStats($('statsFormDiv'));
		}		
		toggle_stats();		
	});
	
	var container = $('statsFormDiv');
	if(container){
		container.addEvent("submit:relay($('stats-form'))", function(event){
			
			event.stop();
			
			$('loading-div').addClass('loading-small');		
			
			new Request({
	            url: this.get("action"),
	            data: this,
	            onComplete: function() {
	              
	               var json_data = JSON.decode(this.response.text);	
	               if(!json_data["proceed"]){            	
	           			alert(json_data["msg"]);
	               } else{
	            	   	$('profile-stats').empty();
	       				$('profile-stats').addClass('loading1');       				
	       				renderStats();
	       				toggle_stats();
	               }              
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();
	
		});	
	}
	
});

var inOut_stats = 1;
var m1_array_stats = new Array(); 
var m2_array_stats = new Array();
var morphObject_stats = new Object();
var morphObject2_stats = new Object();

function toggle_stats(){
	
	morphObject2_stats.start({
		'margin-left': m2_array_stats[inOut_stats],				
	});
	morphObject_stats.start({
		'margin-left': m1_array_stats[inOut_stats],				
	});		
	inOut_stats = 1- inOut_stats;
	
}

function editStats(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=other&tmpl=component";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('statsFormDiv'),
		onSuccess: function(responseText){ $('statsFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');}
		}).send();	
	
}
function renderStats(){
	
	var json_data = JSON.decode($('profile-stats').get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=aother&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('profile-stats'),
		onSuccess: function(responseText){ $('profile-stats').removeClass('loading1');	$('loading-div').removeClass('loading-small');},
		onFailure:function(){ profileFailure(this); }
		}).send();
}