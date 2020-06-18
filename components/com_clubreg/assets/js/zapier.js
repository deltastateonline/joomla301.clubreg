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
	}	;	
	
	//https://joomla301.local/index.php?option=com_clubreg&view=zapier&layout=view&tmpl=component&format=json
	
	
	var params = "option=com_clubreg&view=payment&layout=edit&tmpl=component&format=raw";		
	//self.rBefore = beforeAction;
};


zapierViewRequestDef.prototype.useResults = function(response){	

	console.log(response)
	
}

var zapierViewRequestConfig = new zapierViewRequestDef() ;

ClubregObjectDefinition.prototype.viewZapier= function(requestConfig){	
	self = this;	
	self.loadAjaxRequest(requestConfig);  
}

jQuery(document).ready(function(){		
	
	jQuery(document).on('click','#zapier',function(event){	
		console.log("here");
		
		
		
		zapierViewRequestConfig.rData['member_key'] = jQuery(this).data('pk');
		zapierViewRequestConfig.rData[token] = 1;
		
		ClubRegObject.viewZapier(zapierViewRequestConfig);	
		
	});
	
	
});