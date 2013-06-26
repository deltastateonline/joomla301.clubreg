window.addEvent('domready', function() {
		
	
	$$('.clubregTab').addEvents({
	
		click:function(event){
			var ntab = $(this).get('href');
			Cookie.write('activeTab', ntab.slice(1) );
		}
	});	
	
});