/*
---
description: This class gives you a method to upload files 'the ajax way'

license: MIT-style

authors:
- Arian Stolwijk

requires: [Core/Class.Extras, Core/Element, Core/Element.Event, Core/Element.Style]

provides: [Element.iFrameFormRequest, iFrameFormRequest]

...
*/

/**
 * @author Arian Stolwijk
 * Idea taken from http://www.webtoolkit.info/ajax-file-upload.html
 */

var iFrameFormRequest = new Class({

	Implements: [Options, Events],

	options: { 
		/*onRequest: function(){},
		onComplete: function(data){},
		onFailure: function(){}, 	*/	
		eventName: 'submit'
	},

	initialize: function(form, options){
		this.setOptions(options);
		var frameId = this.frameId = String.uniqueID();
		var loading = false;

		this.form = document.id(form);

		this.formEvent = function(){			
			loading = true;			
			this.fireEvent('request');
		}.bind(this);

		this.iframe = new IFrame({
			name: frameId,
			styles: {
				display: 'none'				
			},
			src: 'about:blank',
			events: {
				load: function(){					
					var doc = this.iframe.contentWindow.document;			
					
					if (loading){
						var doc = this.iframe.contentWindow.document; 
						if (doc && doc.location.href != 'about:blank'){
							this.complete(doc.body.innerHTML);
						} else {
							this.fireEvent('failure');
						}
						loading = false;
					}
					
					if (doc && doc.location.href != 'about:blank'){
						this.complete(doc.body.innerHTML);
					}
					
				}.bind(this)
			}
		}).inject(document.body);

		this.attach();
	},

	complete: function(response){		
		this.fireEvent('complete', response);
	},

	send: function(){		
		this.form.submit();
		this.formEvent();
	},

	attach: function(){		
		this.target = this.form.get('target');
		this.form.set('target', this.frameId).addEvent(this.options.eventName, this.formEvent);
	},

	detach: function(){
		this.form.set('target', this.target)
			.removeEvent(this.options.eventName, this.formEvent);
	},
	toElement: function(){
		return this.iframe;
	}

});

Element.implement('iFrameFormRequest', function(options){	
	this.store('iFrameFormRequest', new iFrameFormRequest(this, options));
	return this;
});
