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

/**

 * Definition for creating alerts
 */
function alertsRequestDef(){
	self = this;
	self.rUrl  =  "";
	self.rMethod  = "post";
	self.rData  = {}	;	
};
alertsRequestDef.prototype.useResults = function(response){	
	self = this;	
	jQuery(self.whereTo).removeClass("loading1");	
	jQuery(self.whereTo).html(response);
}



/**
 * Definition for deleting
 */
function deleteRequestDef(){	
	
	self = this;
	self.rUrl  =  "index.php";
	self.rMethod  = "post";
	self.rData  = {}	;	
	
	self.creator = {};
	self.rBefore = function(args){		
		return ;
	};
	
};

deleteRequestDef.prototype.useResults = function(response){
	self = this;
	Joomla.removeMessages();	
	self.creator.parents('div.cgroup-div').fadeOut();
}
deleteRequestDef.prototype.useFailedResults = function(response){	
	self.creator.parents('div.cgroup-div').removeClass("loading1");
	Joomla.renderMessages({error:response.errors});	
};

function paymentsRequestDef(){
	self = this;
	self.rUrl  =  "";
	self.rMethod  = "post";
	self.rData  = {}	;	
};

paymentsRequestDef.prototype.useResults = function(response){
	self = this;	
	jQuery(self.whereTo).removeClass("loading1");	
	jQuery(self.whereTo).html(response);
}

var alertRequestConfig = new alertsRequestDef();
var paymentRequestConfig = new paymentsRequestDef();
var deleteRequestConfig =  new deleteRequestDef() ;

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
			var counted = 0;
			var checkBoxes = [];
			jQuery('input[name^=cid]').each(function(){
				if(jQuery(this).attr("checked")){
					counted++;						
					checkBoxes.push(jQuery(this).val());// add this to the array			
				}
			});			
					
			if(counted == 0){
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
			
			jQuery("#adminForm [name=clubreg_boxes]").val(JSON.stringify(checkBoxes));// update the checkbox control	
			Joomla.submitbutton('regmembers.batchUpdate');
			
		});	
	
	/**
	 * regdiv_{id} alerts are written into this container
	 * regdata_{id} member information are stored in here
	 * 
	 */
	
	jQuery('#find-player-list').on('click','[rel=anniversary]',function(){
		
		var memberId = jQuery(this).data('memberid');
		jQuery('#regdiv_'+memberId).addClass("loading1");
		jQuery('#regdata_'+memberId).fadeOut('slow',function(){ //
			jQuery('#regdiv_'+memberId).fadeIn(); //
		});
		
		var alertdata = jQuery(this).data('alertdata');
		
		alertdata[token] = 1;
		alertdata['source_page'] = 'regmembers';
		
		var params = "option=com_clubreg&view=alert&layout=edit&tmpl=component&format=raw";		
		alertRequestConfig.rUrl =  "index.php?"+params;	
		alertRequestConfig.rData = alertdata;
		alertRequestConfig.whereTo = '#regdiv_'+memberId;		
		ClubRegObject.loadAjaxRequestHTML(alertRequestConfig);
		
	});
	
	
	jQuery('#find-player-list').on('click','.toggle-alerts-div',function(){
		
		var memberId = jQuery(this).data('memberid');
		jQuery('#regdiv_'+memberId).fadeOut('slow', function(){
			jQuery('#regdata_'+memberId).fadeIn();		
		});
		
	});
	
	jQuery('#find-player-list').on('click','[rel=delete-member]',function(){	
		
		var deleteme = confirm("Are you sure you want to delete this item?");
		
		if(deleteme){		

			jQuery(this).parents('div.cgroup-div').addClass("loading1");
			var json_data = {};
			json_data[token]=1; 
			json_data["member_key"]= jQuery(this).data('memberkey');		
			json_data["option"]= "com_clubreg";
			json_data["task"]= "regmembers.deletemembers";
			
			deleteRequestConfig.rData  = json_data; 			
			deleteRequestConfig.creator = jQuery(this);			
			ClubRegObject.loadAjaxRequest(deleteRequestConfig);
		}
	});
	
	jQuery('#find-player-list').on('click','[rel=payment]',function(){
		
		var memberId = jQuery(this).data('memberid');
		jQuery('#regdiv_'+memberId).addClass("loading1");
		jQuery('#regdata_'+memberId).fadeOut('slow',function(){ //
			jQuery('#regdiv_'+memberId).fadeIn(); //
		});
		
		var data = jQuery(this).data('paymentdata'); 
		
		data[token] = 1;
		data["source"] = "regmembers";
		// perform the request then add the response to the container specified in the whereTo
		// required data to show include {member_key , token_value , payment_key 
		var params = "option=com_clubreg&view=payment&layout=edit&tmpl=component&format=raw";		
		paymentRequestConfig.rUrl =  "index.php?"+params;	
		paymentRequestConfig.rData = data;
		paymentRequestConfig.whereTo = '#regdiv_'+memberId;		
		ClubRegObject.loadAjaxRequestHTML(paymentRequestConfig);
		
	});	
	
	jQuery('#find-player-list').on('click','#toggle-payments-div',function(){
		
		var memberId = jQuery(this).data('memberid');
		jQuery('#regdiv_'+memberId).fadeOut('slow', function(){
			jQuery('#regdata_'+memberId).fadeIn();		
		});
		
	});
	
});