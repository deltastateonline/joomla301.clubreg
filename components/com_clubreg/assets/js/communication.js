// A $( document ).ready() block.
jQuery( document ).ready(function() {
	
	function commClass(gControl){	
		
		this.groupControl = gControl;
		this.selectedGroups = [];		
		this.addGroup = function(gId){	
			var found = this.selectedGroups.indexOf(gId);	
			
			

			if(found == -1){
				this.selectedGroups.push(gId);
				this.updateControl();
			}
		};
		this.removeGroup = function(gId){
			
			var found = this.selectedGroups.indexOf(gId);			
			if(found != -1){
				this.selectedGroups.splice(found,1);
			}	
			this.updateControl();
		}
		this.render = function(action){
			console.log(action,this.selectedGroups);
		}		
		this.updateControl = function(){			
			this.groupControl.val(JSON.stringify(this.selectedGroups));
		}
		this.init = function(){			
			if(this.groupControl.val() == 0){
				this.selectedGroups = [];
			}else{
				var tmp = jQuery.parseJSON(this.groupControl.val());				
				this.selectedGroups = tmp;
				
				 
			}
		};
	}
	
	
	commObject = new commClass(jQuery("#jform_comm_groups"));
	commObject.init();
	
	
	
	jQuery('div.sendto-hide-groups').slideUp();
	
	/**
	 * Move from my groups to Send to
	 */
	jQuery( 'div.sendto-groupbtns' ).on('click','a.btn',function(event){
		
		var groupid = jQuery(this).data('groupid');		
		jQuery("div.sendto-groups").append(jQuery(this).addClass('btn-success'));	
		jQuery("div.sendto-groups").append(" ");
		commObject.addGroup(groupid);		
	});
	
	/**
	 * Move from Send to to my groups
	 */
	
	jQuery( 'div.sendto-groups' ).on('click','a.btn',function(event){	
		var groupid = jQuery(this).data('groupid');		
		jQuery("div.sendto-groupbtns").append(jQuery(this).removeClass('btn-success'));
		jQuery("div.sendto-groupbtns").append(" ");
		commObject.removeGroup(groupid);		
	});
	
	jQuery( document ).on('click','a.sendto-show-groups',function(event){
		
		jQuery('div.sendto-hide-groups').slideToggle();
		
		if(this.get('rel') == 0){
			this.set('rel','1');
			this.set('html',"-");	
		}else{
			this.set('rel','0');
			this.set('html',"+");	
		}		
	});
	
	jQuery( document ).on('click','#btSendMsg',function(event){			
		
		if(commObject.selectedGroups.length == 0){
			event.stopPropagation();
			event.preventDefault();
			
			alert("Please add some groups to send this message to");
		}else{
			jQuery('#clubregTask').val('communication.send');
		}
	})
	
	
	
	
	
	
	
});