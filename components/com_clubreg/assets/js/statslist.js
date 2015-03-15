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


var statsRequestConfig = {
		rUrl: "",	
		rMethod :"post",
		rData :{}
		
};

jQuery(document).ready(function(){
	
        jQuery('div.btn-stats-group').on('click','a.btn-stats-btn',function(){
        	var cvalue = jQuery(this).data('statsvalue');        
        	if(cvalue == 1){
        		jQuery(this).parents('div.btn-group').find('a.btn-mini').removeClass('btn-danger');        		
        		jQuery(this).toggleClass('btn-success', '' );
        	}else{
        		jQuery(this).parents('div.btn-group').find('a.btn-mini').removeClass('btn-success');
        		jQuery(this).toggleClass('btn-danger', '' );
        	}
        	
        	var member_key = jQuery(this).parents('div.cgroup-div-stats').data('member_key');  
        	
        	jQuery('#statsAdminForm #pk').val(member_key);       	
        	
        	statsRequestConfig.rData = jQuery('#statsAdminForm').serialize();
        	
        	ClubRegObject.loadAjaxRequest(statsRequestConfig);
   
        	
        });
       
});
function statsDateChanged(){
	
	 var value = jQuery("#stats_date").val();
     
     console.log(value);
}