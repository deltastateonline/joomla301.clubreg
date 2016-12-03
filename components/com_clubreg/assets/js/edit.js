window.addEvent('domready', function () {	
	
	if($('jformgroup')){
		
		
		group_onload($('jformgroup'),$('jformgroup').value,$('jform_playertype').value)
		
		$('jformgroup').addEvent('change', function (){			
			group_onchange(this,$("jformsubgroup"),-1);
		});
	}
	
	if($('back-to-profile')){
		if($('jform_member_id').value == 0){
			$('back-to-profile').hide();
		}
	}
	if($('back-to-list')){
		if($('jform_member_id').value > 0){
			$('back-to-list').hide();
		}
		
	}
	
	
	$('edit-form').addEvent('submit', function(event){
		
		event.stop();
		$('loading-div').addClass('loading-small');		
		
		new Request({
            url: this.get("action"),
            data: this,
            onComplete: function() {
              
               var json_data = JSON.decode(this.response.text);	
               if(!json_data["proceed"]){            	
            	   render_msg(json_data["msg"]);
               } else{
            	  if(json_data["isnew"]){
            		  
            		  if(json_data["member_key"]){
            			  $('jform_member_key').value = json_data["member_key"];
            		  }
            		  
            		  if(json_data["member_id"]){
            			  $('jform_member_id').value = json_data["member_id"];  
            			  $('back-to-profile').show();
            			  $('back-to-list').hide();
            		  }
            		  
            		  if(json_data["pk"]){            			
            			 var allpks =  $(document).getElements('input[name=pk]');            			
            			 allpks.each(function(a_pk){ a_pk.value = json_data["pk"]; });
            		  }
            	  }
            	  s_or_f = 1;
            	  render_msg(json_data["msg"]);
               }              
               $('loading-div').removeClass('loading-small');
            },
            onFailure:function(){ profileFailure(this); },
            onError:function(){ return true}
            
        }).send();
		
	})
});
jQuery(document).ready(function(){
	if(jQuery('#jform_useaddress') && jQuery('#jform_postal_address')){
		
		jQuery('#jform_useaddress').on('click',function(){
			if(jQuery('#jform_useaddress').is(':checked')){
				var pAddress = jQuery('#jform_address').val();
				pAddress = pAddress + "\n"+ jQuery('#jform_suburb').val();
				pAddress = pAddress + "\n"+ jQuery('#jform_ausstate').val();
				pAddress = pAddress + " "+ jQuery('#jform_postcode').val();
				
				jQuery('#jform_postal_address').val(pAddress);
			}
		});
	}
})