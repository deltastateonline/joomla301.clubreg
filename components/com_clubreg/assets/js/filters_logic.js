window.addEvent('domready', function () {	
	

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
	var ignore_these = ["stats_date","end_date"];
	all_filters.each(function(a_filter){		
			var s_item = a_filter.value;
			
			if((ignore_these.indexOf(a_filter.name) > -1)){
				
			}else if(s_item && ! empty_str.test(s_item)){
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