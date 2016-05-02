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
});

jQuery(document).ready(function() {
	
	if(jQuery('#playertype')){
		
	}
	
	var all_selected = "";
	var empty_str = /^\s*$/;
	
	var all_filters =  jQuery('#adminForm input:text');	
	var ignore_these = ["stats_date","end_date"];
	
	all_filters.each(function(idx){		
		
		var a_filter = all_filters[idx];
		var s_item = a_filter.value;
		if((ignore_these.indexOf(a_filter.name) > -1)){
			
		}else if(s_item && ! empty_str.test(s_item)){
			all_selected = all_selected + "<span class='label label-info '>"+a_filter.value+"</span><span class='divider'>&nbsp;</span>";
		}
		
	});
	
	var all_filters =  jQuery('#adminForm select');
	
	var ignore_these = ["playertype","directionTable","sortTable","limit"];
	all_filters.each(function(idx){	
		
		var a_filter = all_filters[idx];		
		
		if(a_filter.value == -1 || (ignore_these.indexOf(a_filter.name) > -1)){
			
		}else{	
			var s_item = jQuery(a_filter).find(":selected").text()
			all_selected = all_selected +  "<span class='label label-info'>"+s_item+"</span> <span class='divider'>&nbsp;</span>";			
		}		
	});	
	
	jQuery('#reg-filter-selected').html(all_selected);
});