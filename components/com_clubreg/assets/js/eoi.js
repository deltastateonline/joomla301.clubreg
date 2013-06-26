window.addEvent('domready', function () {		
	
	
	$$(".openFieldsets").addEvent('click',function(event){
		
		$inner_txt = this.get('html');
		var idx = this.get('rel');
		var fldSets = "fldst"+idx;		
		
		if($inner_txt == "[+]"){
			this.set('html',"[-]");				
		}else{
			this.set('html',"[+]");			
		}
		
	});
	
});
