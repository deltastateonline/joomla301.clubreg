window.addEvent('domready', function () {	
	
	var showFilters =  new Fx.Slide("all_filters");
	$("all_filters").slide('hide').setStyle('visibility', 'visible');
	
	$$(".show-filters").addEvent('click',function(event){		
		showFilters.toggle();	
		if(this.get('rel') == 0){
			this.set('rel','1');
			this.set('html',"Hide Filters");	
		}else{
			this.set('rel','0');
			this.set('html',"Show Filters");	
		}
	});
	
	if($('group')){
		
		if($("subgroup").value > 0){
			var c_sgroup = $("subgroup").value;
			group_onchange($('group'),$("subgroup"),c_sgroup);				
		}
		
		$('group').addEvent('change', function (){	
			group_onchange(this,$("subgroup"),-1);
		});
	}
	
});


function statsButtonRequestDef(){
		self = this;
		self.rUrl  =  "";
		self.rMethod  = "post";
		self.rData  = {}	;	
};

statsButtonRequestDef.prototype.useResults = function(response){
	
	Joomla.removeMessages();
	
	if(response.pk){
		var cDiv = jQuery("div.cgroup-div-stats").filter("[data-member_key=\""+response.pk+"\"]");			
	}
}

statsButtonRequestDef.prototype.useFailedResults = function(response){
	
	var cDiv = jQuery("div.cgroup-div-stats").filter("[data-member_key=\""+response.pk+"\"]");	
	var statsButton = cDiv.find('a.btn-mini');	
	statsButton.removeClass('btn-danger').removeClass('btn-success'); // remove the styles
	
	
	if(response.errors){		
		Joomla.renderMessages(response.errors);					
	}
}

/**
 * Config for button click request
 */
var statsButtonsRequestConfig = new statsButtonRequestDef();



/**
 * Definition for  
 */

function statsListRequestDef(){
	self = this;
	self.rUrl  =  "";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

/**
 * Process the returned result
 */
statsListRequestDef.prototype.useResults  = function(response){
	
	jQuery('#stats_loading').removeClass('loading-small');
	if(response.statsProfile == undefined ){
		
	}else{
		jQuery.each(response.statsProfile,   function(index, item) {	
			
			var cDiv = jQuery("div.cgroup-div-stats").filter("[data-member_key=\""+index+"\"]");	
			var statsButton = cDiv.find('a.btn-mini').removeClass('btn-danger').removeClass('btn-success');;	
			
			if(statsButton != undefined){			
				if(item == "yes"){				
					cDiv.find("[data-statsvalue='"+item+"']").addClass('btn-success');				
				}else if(item == "no"){				
					cDiv.find("[data-statsvalue='"+item+"']").addClass('btn-danger');			
				}			
			}	
		});	
	}
}


statsListRequestDef.prototype.useFailedResults = function(response){
	
	jQuery('#stats_loading').removeClass('loading-small');
	if(response.errors){		
		Joomla.renderMessages(response.errors);					
	}
}


statsListRequestDef.prototype.rBefore = function(){
	jQuery('#stats_loading').addClass('loading-small');
}

var statsListRequestConfig = new statsListRequestDef();


ClubregObjectDefinition.prototype.currentProfiles =  new Array();


jQuery(document).ready(function(){
	
	
		jQuery.each(jQuery("div.cgroup-div-stats"), function(index, item) {
			ClubRegObject.currentProfiles.push(jQuery(item).data('member_key'));
		});
		
		
		ClubRegObject.getStats(statsListRequestConfig,ClubRegObject.currentProfiles); // get the classes for each of the buttons on page
	
	
        jQuery('div.btn-stats-group').on('click','a.btn-stats-btn',function(){
        	var cvalue = jQuery(this).data('statsvalue');  
        	var proceed = true;
        	
        	if(cvalue == "yes"){
        		if(jQuery(this).hasClass('btn-success')){
        			proceed = false;       		
        		}else{
        			jQuery(this).parents('div.btn-group').find('a.btn-mini').removeClass('btn-danger');
	        		jQuery(this).addClass('btn-success');
        		}        		
        	}else if(cvalue == "no"){
        		
        		if(jQuery(this).hasClass('btn-danger')){
        			proceed = false;
        		}else{
        			jQuery(this).parents('div.btn-group').find('a.btn-mini').removeClass('btn-success');
        			jQuery(this).addClass('btn-danger');
        		}        		
        	}
        	
        	if(proceed){
	        	// set the member key
	        	var memberKey = jQuery(this).parents('div.cgroup-div-stats').data('member_key');
	        	jQuery('#statsAdminForm #pk').val(memberKey);	        	
	        	
	        	// set the stats date        	
	        	var statsDate = jQuery("#adminForm #stats_date").val();
	        	jQuery('#statsAdminForm #stats_date').val(statsDate);
	        	
	        	// set the stats value        	
	        	jQuery('#statsAdminForm #stats_value').val(cvalue);        	
	        	
	        	statsButtonsRequestConfig.rData = jQuery('#statsAdminForm').serialize();        	
	        	ClubRegObject.loadAjaxRequest(statsButtonsRequestConfig);
	        	
        	}
        	
        });
       
});

/**
 * Stats date has been changed
 */
function statsDateChanged(){	 
	ClubRegObject.getStats(statsListRequestConfig,ClubRegObject.currentProfiles);
}