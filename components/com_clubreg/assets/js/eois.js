window.addEvent('domready', function () {	
	
	$$('.reg-well').each(function(el) {
	   // el.slide('hide').setStyle('visibility', 'visible');
	});
	
	$$('.reg-button-all').addEvent('click',function(event){	
		
		if(this.get('html') == "+"){ ticon = "-";	}else{ ticon = "+";	}
		this.set('html',ticon);
		
		$$('.reg-well').each(function(el) {
			var searchSlider =  new Fx.Slide(el.id);
			searchSlider.toggle();
		});
		
	});
	
	$$(".reg-button").addEvent('click',function(event){
		
		$inner_txt = this.get('html');
		var idx = this.get('rel');
		
		if($inner_txt == "+"){
			this.set('html',"-");				
		}else{
			this.set('html',"+");			
		}
		
		var searchSlider =  new Fx.Slide("regdata_"+idx);
		searchSlider.toggle();
		
	

		
	});
	
});