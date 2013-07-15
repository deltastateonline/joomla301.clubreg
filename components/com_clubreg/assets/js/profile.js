window.addEvent('domready', function () {	
	
	
	
	if($('profile-division')){
		//$('profile-division').slide('hide').setStyle('visibility', 'visible');
		
		$$(".profile-div-button").addEvent('click',function(event){	
			if(this.get('html') == "+"){ ticon = "-";	}else{ ticon = "+";	}
			this.set('html',ticon);
			var searchSlider =  new Fx.Slide("profile-division");
			searchSlider.toggle();	
			
		});
		
		
	}
});