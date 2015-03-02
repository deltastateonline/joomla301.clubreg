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