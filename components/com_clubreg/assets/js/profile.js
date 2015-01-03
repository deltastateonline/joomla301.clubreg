window.addEvent('domready', function () {
	
	if($('profile-division')){
		//$('profile-division').slide('hide').setStyle('visibility', 'visible');
		
		$$(".profile-div-button").addEvent('click',function(event){	
			if(this.get('html') == "+"){ ticon = "-";	}else{ ticon = "+";	}
			this.set('html',ticon);
			var searchSlider =  new Fx.Slide("profile-division");
			searchSlider.toggle();	
			
		});		
	}
	
	$("profilebtn").addEvent('click',function(event){		
		 var fileInput = jQuery("#uploadimage").trigger("click");
	});
	
	if($('profile-pix-form')){
		
		
		var iFrame = new iFrameFormRequest('profile-pix-form',{
			onRequest: function(){
				
				 $('loading-div').addClass('loading-small');
			},
			onComplete: function(response){				
				var proceedData = JSON.decode(response);
				console.log(response);
				if(proceedData["proceed"]){									
					 s_or_f = 1;
					 render_msg(proceedData["msg"]);					
				}else{
					var msg_text  = "";					
					if(proceedData["msg"]){ 						
						render_msg(proceedData["msg"]);
					}else{
						msg_text = "Unable to complete action";
						render_msg(msg_text);
					}
				}			
			},			
            onFailure:function(){ profileFailure(this); }
		});		
	}	
});

function uploadPic(input) {
	
	var patt = new RegExp("image");
	if(patt.test(input.files[0].type)){	
	
		if (input.files && input.files[0]) {
			var width = $("profileimg").get("width");
			var height = $("profileimg").get("height");
			var reader = new FileReader();
			reader.onload = function(e) {
				$('profileimg')
				.set('src', e.target.result)
				.set("width",width)				
			};
			reader.readAsDataURL(input.files[0]);
			input.form.submit();			
		}
	}else{
		msg_text = "Please select an image file!!";
		render_msg(msg_text);
	}
} 
