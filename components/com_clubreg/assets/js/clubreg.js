function ClubregObjectDefinition(){
	
	self = this;
}

ClubregObjectDefinition.prototype.loadAjaxRequest = function(reqConfig){	
	
	jQuery.ajax({
		url: reqConfig.rUrl,
		type: reqConfig.rMethod,
		dataType: 'json',
		cache: false,
		data:reqConfig.rData,
		beforeSend: reqConfig.rBefore,
		success: function( response, textStatus, XMLHttpRequest ) {
			
			if(response.proceed){
				Joomla.removeMessages();
				reqConfig.useResults(response);
			}else{
				if(reqConfig.useFailedResults !== undefined){
					reqConfig.useFailedResults(response);
				}else{				
					if(response.errors){					
						Joomla.renderMessages(response.errors);					
					}
				}
			}
		},
		error: function( XMLHttpRequest, textStatus, errorThrown ) {			
			var fatalError = ['warning'];
			
			fatalError = {};
			fatalError.error = [];			
			fatalError.error[0] = "Unable to Process Request ";
			fatalError.error[1] = errorThrown;			
			Joomla.renderMessages(fatalError);	
			
			if(reqConfig.useFailedResults !== undefined){
				reqConfig.useFailedResults(response);
			}
			
		},
		complete:function(XMLHttpRequest, textStatus){		
			// where requestObject is a string, which is used as the trigger
			// tabName can be a string or an object
			if(reqConfig.requestObject !== undefined){				
				jQuery(document).trigger(reqConfig.requestObject,[reqConfig.tabName]);
			}
		}
	});	
	
};

ClubregObjectDefinition.prototype.loadAjaxRequestHTML = function(reqConfig){
	
	
	jQuery.ajax({
		url: reqConfig.rUrl,
		type: reqConfig.rMethod,
		dataType: 'html',
		cache: false,
		data:reqConfig.rData,
		beforeSend: reqConfig.rBefore,
		success: function( response, textStatus, XMLHttpRequest ) {			
			Joomla.removeMessages();
			reqConfig.useResults(response);			

		},
		error: function( XMLHttpRequest, textStatus, errorThrown ) {			
			var fatalError = ['warning'];
			
			fatalError = {};
			fatalError.error = [];			
			fatalError.error[0] = "Unable to Process Request ";
			fatalError.error[1] = errorThrown;			
			Joomla.renderMessages(fatalError);	
			
			if(reqConfig.useFailedResults !== undefined){
				reqConfig.useFailedResults(response);
			}
			
		},
		complete:function(XMLHttpRequest, textStatus){		
			// where requestObject is a string, which is used as the trigger
			// tabName can be a string or an object
			if(reqConfig.requestObject !== undefined){				
				jQuery(document).trigger(reqConfig.requestObject,[reqConfig.tabName]);
			}
		}
	});	
	
};

ClubregObjectDefinition.prototype.getStats= function(requestConfig,profileArray){
	
	self = this;	
	
	if(profileArray.length > 0){		
		
		var requestData = {};
		
		requestData["member_ids"] = profileArray;
		requestData["task"] = "stats.getstats";
		requestData["option"] = jQuery('#statsAdminForm #option').val();
		requestData["Itemid"] = jQuery('#statsAdminForm #Itemid').val();
		requestData["stats_date"] = jQuery("#adminForm #stats_date").val();
		requestData[token] = 1;
		requestConfig.rData = requestData; 		
		
		self.loadAjaxRequest(requestConfig);    
	}
	
}

ClubregObjectDefinition.prototype.debounce = function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

var failedResponse = {		
	useFailedResults: function(response){
		s_or_f = 0;
		render_msg(response.errors);
	}
}


var ClubRegObject = new ClubregObjectDefinition();

function beforeAction(jqXHR){	
	jQuery('#loading-div').addClass('loading-small');
}
function afterAction(){
	jQuery('#loading-div').removeClass('loading-small');
}
