/**
 * This script lives in the embedded form window.
 */

var Embed = {
	embedId: '',
	outsideHost: '',

	init: function(embedId) {
		Embed.init(embedId, "");
	},
	
	init: function(embedId, outsideHost) {
		Embed.embedId = embedId;
		Embed.outsideHost = outsideHost;
	},

	updateUrl: function(doScroll) {
		var actualHeight = Embed.getBodyHeight();
		
		if(doScroll){
			parent.location= Embed.outsideHost + "#ht=" + actualHeight;
		} else {
			parent.location= Embed.outsideHost + "#ht=" + actualHeight + "#doScroll=" + doScroll;
		}
	},
	
	getBodyHeight: function() {
		//determine the width of the body and see if it is wider than the parent. if so we need to add space for the scroll bars
		//it turns out that in all browsers the offsetWidth seems to be the width of the frame while the scrollWidth being the total width		
		var extra = 0;
		if (document.documentElement.scrollWidth > document.documentElement.offsetWidth) {
			extra = 20; //scroll bars typically take up 20 extra pixels
		}
		
		if (navigator.userAgent.indexOf('MSIE 7') != -1 || navigator.userAgent.indexOf('MSIE 6') != -1) {
			return document.body.offsetHeight + 30 + extra; //IE 7/6 has some strange issue and needs 30px offset
		} else {
			return document.body.offsetHeight + 16 + extra; //all other browsers have a 16px offset
		}
	},
	
	publishHeight: function(doScroll) {
		if(parent.postMessage) {
			parent.postMessage(Embed.embedId + ':' + Embed.getBodyHeight() + ':' + doScroll, '*');
		} else {
			Embed.updateUrl(doScroll);
		}
	},
	
	onLoad: function() {
		var form = document.getElementById('FSForm');
		if(form && !document.getElementById('EmbeddedForm')) {
			var embedField = document.createElement('input');
			embedField.setAttribute('id','EmbeddedForm');
			embedField.setAttribute('name','EmbeddedForm');
			embedField.setAttribute('value','EmbeddedForm');
			embedField.setAttribute('type','hidden');
			embedField.setAttribute('style','display: none;');
			form.appendChild(embedField);
		}
		if(form && !document.getElementById('EmbedId')) {
			var embedField = document.createElement('input');
			embedField.setAttribute('id','EmbedId');
			embedField.setAttribute('name','EmbedId');
			embedField.setAttribute('value',Embed.embedId);
			embedField.setAttribute('type','hidden');
			embedField.setAttribute('style','display: none;');
			form.appendChild(embedField);
		}
		if(form && !document.getElementById('HostUrl')) {
			var embedField = document.createElement('input');
			embedField.setAttribute('id','HostUrl');
			embedField.setAttribute('name','HostUrl');
			embedField.setAttribute('value',Embed.outsideHost);
			embedField.setAttribute('type','hidden');
			embedField.setAttribute('style','display: none;');
			form.appendChild(embedField);
		}
		
		//client side style changes
		Embed.makeTransparent();
		Embed.make100PercentWidth();
		
		Embed.publishHeight(true);
		//Added this code to make the page scroll to the top where it displays "Some fields are required" message
		if(form && document.getElementById('showWarning')){
			document.getElementById('showWarning').scrollIntoView();
		}
		
		if(form && document.getElementById('showInfoSavedMsg')){
			document.getElementById('showInfoSavedMsg').scrollIntoView();
		}
	},
	
	makeTransparent: function() {
		document.body.style.background="transparent";
	},
	
	make100PercentWidth: function() {
		if (document.getElementById('no_100_width')) {
			return;
		} else {
			//since we have to update class styles we can not use DOM to directly access the elements to be updated
			//add a new style tag to the head of the document
			var head = document.getElementsByTagName("head")[0];
			var cssNode = document.createElement('style');
			cssNode.type = "text/css";
			cssNode.media = 'screen';
			cssNode.title = 'EmbedCSSChanges';
			head.appendChild(cssNode);
			
			//after adding the new style tag we must look for it in the stylesheets array before we can add rules			
			for (var i=0; i < document.styleSheets.length; i++) {
				if (document.styleSheets[i].title == "EmbedCSSChanges") {
					if (document.styleSheets[i].addRule) {// Browser is IE?
						document.styleSheets[i].addRule(".form_table", "width: auto !important;"); 
						document.styleSheets[i].addRule(".outside_container", "width: auto !important;");// Yes, add IE style
					} else {
						document.styleSheets[i].insertRule(".outside_container, .form_table{width: auto !important;}", 0); //add Moz style.
					} 
				}
			}
		}
	}
};

if (window.addEventListener) {
	window.addEventListener("load", Embed.onLoad, false);
} else {
	window.attachEvent("onload", Embed.onLoad); // ie
}
