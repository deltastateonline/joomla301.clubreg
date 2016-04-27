window.addEvent('domready', function () {	

	if($('group')){	
		
		if($("subgroup").value > 0){
			var c_sgroup = $("subgroup").value;
			group_onchange($('group'),$("subgroup"),c_sgroup);				
		}
		
		$('group').addEvent('change', function (){	
			group_onchange(this,$("subgroup"),-1);
		});
	}
	
	if($('batch_group')){
		
		if($("batch_subgroup").value > 0){
			var c_sgroup = $("batch_subgroup").value;
			group_onchange($('batch_group'),$("batch_subgroup"),c_sgroup);				
		}
		
		$('batch_group').addEvent('change', function (){	
			group_onchange(this,$("batch_subgroup"),-1);
		});
	}
	
	if($('batch_playertype')){
		$('batch_playertype').addEvent('change', function (){
			var playerType = $('batch_playertype').value;
			if(playerType == -1){
				playerType = "junior";
			}
			group_onload($("batch_group"),-1,playerType);
			group_onchange($("batch_group"),$("batch_subgroup"),-1);
		});
	}
	
});

jQuery(document).ready(function() {
	
	
	jQuery('#all_filters').slideUp();	
	jQuery('#all_batch_filters').slideUp();	
	
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
	
	jQuery(".show-batch-filters").on('click',function(event){		
		jQuery('#all_batch_filters').slideToggle();
	});
	
	jQuery(".hide-batch-filters").on('click', function(event){			
		jQuery('#all_batch_filters').slideToggle();
	});
	
	
	
	jQuery(document).on('click',".btn-batch-update",function(event){		
			
			event.stopPropagation();
			event.preventDefault();		
				
			if(document.adminForm.boxchecked.value == 0){
				alert(selectOneString);		
				return;
			}
			
			var batchSelects = 0;
			jQuery('select[id^="batch_"]').each(function(){
				
				var s_item = jQuery(this).find("option:selected");				
				
				if(jQuery(this).val() == -1){
					
				}else{	
					batchSelects = batchSelects + 1;
					//all_selected = all_selected +  "<span class='label label-info'>"+s_item.text()+"</span> <span class='divider'>&nbsp;</span>";			
				}
			});
			
			if(batchSelects == 0){
				alert("Please a property to be update.");
				return ;
			}
			
			if(jQuery("#batch_playertype").val()){
				if(jQuery("#batch_playertype").val() != -1 && jQuery("#batch_group").val() < 1 ){
					alert(changedPlayertypeString);
					return;
				}
			}
			
			Joomla.submitbutton('regmembers.batchUpdate');
			
		});		
	
});