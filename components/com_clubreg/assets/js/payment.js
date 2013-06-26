window.addEvent('domready', function () {	
	
	var paymentTabDivs = new renderingDivs();
	var paymentListDiv = new divListRenderer();
	
	
	paymentListDiv.params = "option=com_clubreg&view=ajax&layout=payments&tmpl=component";
	
	if($('paymentFormDiv')){		
		paymentTabDivs.setObjects(new Fx.Morph($('paymentFormDiv')),1);
		paymentTabDivs.setArray1($('paymentFormDiv').getStyle('margin-left'),10);	
	}
	if($('profile-payments')){		
		paymentTabDivs.setObjects(new Fx.Morph($('profile-payments')),2);
		paymentTabDivs.setArray2($('profile-payments').getStyle('margin-left'),profilediverightedge);		
		
		paymentListDiv.setDivObject($('profile-payments'));
		paymentListDiv.renderList();
	}	
	
	$$(".profile-payment-button").addEvent('click',function(event){	
		
		if(paymentTabDivs.inOut){ 
			$('paymentFormDiv').empty();
			$('paymentFormDiv').addClass('loading1');
			addPayment($(this));
		}		
		paymentTabDivs.toggle_div();		
	});
	
	var container = $('paymentFormDiv');
	
	if(container){
		
		container.addEvent("submit:relay($('payment-form'))", function(event){
			
			event.stop();
			
			$('loading-div').addClass('loading-small');		
			
			new Request({
	            url: this.get("action"),
	            data: this,
	            onComplete: function() {
	              
	               var json_data = JSON.decode(this.response.text);	
	               if(!json_data["proceed"]){            	
	           			alert(json_data["msg"]);
	               }
	               if(json_data["isNew"]){
	            	   $('profile-payments').empty();
	            	   $('profile-payments').addClass('loading1');
	            	   paymentListDiv.renderList();
	            	   paymentTabDivs.toggle_div();	
	               }else{
	            	   paymentTabDivs.toggle_div();
	            	   load_payment(json_data["payment_id"]);
	               }
	               $('loading-div').removeClass('loading-small');
	            }
	        }).send();			
	
		});	
		
		container.addEvent("click:relay($('toggle-payments-div'))", function(event){			
			if($(this).id == "toggle-payments-div"){
				paymentTabDivs.toggle_div();
			}
		});
	
		
		 var container = $('profile-payments'); // after an item has been added we should still able to edit it
		 if(container){
			 container.addEvent('click:relay(.profile-payment-button)', function(){ // click event on link
				 $('paymentFormDiv').empty();
				 $('paymentFormDiv').addClass('loading1');
				 addPayment($(this));
				 paymentTabDivs.toggle_div();	
			 });			 
			
		 }
	
	}
	
});

function addPayment(dObject){
	
	var json_data = JSON.decode(dObject.get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=payment&tmpl=component";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',	
		data : json_data,
		update: $('paymentFormDiv'),
		onSuccess: function(responseText){ $('paymentFormDiv').removeClass('loading1');	$('loading-div').removeClass('loading-small');}
		}).send();	
	
}

function load_payment(payment_id){
	var wDiv = $('paymentdata_'+payment_id);
	
	wDiv.empty();	
	wDiv.addClass('loading1');
	
	var json_data = JSON.decode(wDiv.get('rel'));		
	var params = "option=com_clubreg&view=ajax&layout=apayment&tmpl=component&format=raw";		
	var durl = "index.php?"+params;	
	
	var a = new Request.HTML({
		url : durl, 
		method: 'post',		
		update: wDiv,
		data : json_data,
		onSuccess: function(responseText){ wDiv.removeClass('loading1')},
		onFailure:function(){ profileFailure(this); }
		}).send();
}