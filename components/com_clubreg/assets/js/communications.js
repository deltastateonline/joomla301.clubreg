// A $( document ).ready() block.
jQuery( document ).ready(function() {
	
	jQuery('#all_filters').slideUp();
	
	jQuery('.comm_msg').slideUp();
	
	//jQuery( 'div.sendto-groups' ).on('click','a.btn',function(event){	
	
	
	jQuery(".show-filters").on('click',function(event){		
		jQuery('#all_filters').slideToggle();	
		if(this.get('rel') == 0){
			this.set('rel','1');
			this.set('html',"Hide Filters");	
		}else{
			this.set('rel','0');
			this.set('html',"Show Filters");	
		}
	});	
	
	jQuery('.comm_msg_more').on('click',function(event){		
		jQuery(this).parents('div.comms-div').find('div.comm_msg').slideToggle();
		jQuery(this).parents('div.comms-div').find('div.comm_msg_intro').slideToggle();			
	});
	
	var all_selected = "";
	var empty_str = /^\s*$/;
	
	var all_filters =  jQuery('#adminForm').find('input[type=text]');	
	
	all_filters.each(function(){		
			var s_item = jQuery(this).val();			
			
			if(s_item && ! empty_str.test(s_item)){
				all_selected = all_selected + "<span class='label label-info '>"+s_item+"</span><span class='divider'>&nbsp;</span>";
			}
	});
	
	var all_filters =  jQuery('#adminForm').find('select');	
	var ignore_these = ["directionTable","sortTable"];	
	
	// loop thru and get the values from the select boxes
	all_filters.each(function(){
		
		var s_item = jQuery(this).find("option:selected");				
		
		if(jQuery(this).val() == -1 || (ignore_these.indexOf(jQuery(this).attr('name')) > -1)){
			
		}else{			
			all_selected = all_selected +  "<span class='label label-info'>"+s_item.text()+"</span> <span class='divider'>&nbsp;</span>";			
		}
		
	});	
	jQuery('#reg-filter-selected').html(all_selected);
	
	
	jQuery(".comm-delete-message").on('click',function(event){		

		//alert("what now");
		jQuery(this).parents('div.comms-div').fadeOut();
	});	
	
	
});