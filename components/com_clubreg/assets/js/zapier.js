function zapierViewRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {
			"option":"com_clubreg",
			"view":"zapier",
			"layout":"view",
			"tmpl":"component",
			"format":"json",			
	};	
	var params = "option=com_clubreg&view=payment&layout=edit&tmpl=component&format=raw";		
	//self.rBefore = beforeAction;
};


zapierViewRequestDef.prototype.useResults = function(response){	
	
	var data = {'data':response.data};
	
	jQuery.ajax({
		url: zapierUrl,
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: JSON.stringify(data),		
		success: function( response, textStatus, XMLHttpRequest ) {
			if(response.status == "success"){
				s_or_f = 1;
				render_msg("Integration Sent!")
			}
				
		},
		error: function( XMLHttpRequest, textStatus, errorThrown ) {			
			
			
		},
		complete:function(XMLHttpRequest, textStatus){		
			// where requestObject is a string, which is used as the trigger
			// tabName can be a string or an object
			
		}
	});
	
	
	
}

var zapierViewRequestConfig = new zapierViewRequestDef() ;

ClubregObjectDefinition.prototype.viewZapier= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig);  
}

jQuery(document).ready(function(){		
	
	jQuery(document).on('click','#zapier',function(event){	
				
		zapierViewRequestConfig.rData['member_key'] = jQuery(this).data('pk');
		zapierViewRequestConfig.rData[token] = 1;
		
		ClubRegObject.viewZapier(zapierViewRequestConfig);	
		
	});
	
	
});