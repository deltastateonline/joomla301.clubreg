window.addEvent('domready', function () {	
	

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
	
	if($('playertype')){
		$('playertype').addEvent('change', function (){	
			var all_filters =  $('adminForm').getElements('input[type=text]');			
			all_filters.each(function(a_filter){	
				a_filter.value = ""; 
			});
			
			var all_filters =  $('adminForm').getElements('select');			
			all_filters.each(function(a_filter){
				if(a_filter.name == "playertype" || a_filter.name == "member_status" ){
					
				}else{
					a_filter.value = "-1";
				}
			});
		});
	}
	
	var all_selected = "";
	var empty_str = /^\s*$/;
	
	var all_filters =  $('adminForm').getElements('input[type=text]');			
	all_filters.each(function(a_filter){		
			var s_item = a_filter.value;
			if(s_item && ! empty_str.test(s_item)){
				all_selected = all_selected + "<span class='label label-info '>"+a_filter.value+"</span><span class='divider'>&nbsp;</span>";
			}
	});
	
	var all_filters =  $('adminForm').getElements('select');
	var ignore_these = ["playertype","directionTable","sortTable"];
	all_filters.each(function(a_filter){	
		
		var s_item = a_filter.getSelected();
		
		if(a_filter.value == -1 || (ignore_these.indexOf(a_filter.name) > -1)){
			
		}else{			
			all_selected = all_selected +  "<span class='label label-info'>"+s_item[0].get('text')+"</span> <span class='divider'>&nbsp;</span>";			
		}
		
	});	
	$('reg-filter-selected').set('html',all_selected);
	
});