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
	
	if($('group')){
		
		if($("subgroup").value > 0){
			var c_sgroup = $("subgroup").value;
			group_onchange($('group'),$("subgroup"),c_sgroup);				
		}
		
			//
		$('group').addEvent('change', function (){	
			group_onchange(this,$("subgroup"),-1);
		});
	}
	
	if($('playertype')){
		$('playertype').addEvent('change', function (){	
			var all_filters =  $('adminForm').getElements('input[type=text]');			
			all_filters.each(function(a_filter){				
				a_filter.value = ""; 
			});
		});
	}
	
});