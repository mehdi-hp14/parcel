var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
			},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
	BrowserDetect.init();
	
	function Setup() {
		
	if (BrowserDetect.version != "5.5" ) {
			
	  var stretchers = $$('div.accordionWeather', 'div.accordionTrain');		
		var toggler = $$('p.togglerWeather', 'p.toggler');
		
		var disclaimerHide = $$('div#disclaimerHide');
		var togglerDisclaimer = $$('.togglerDisclaimer');
	
		var parkingHidden = $$('.hidden');
		var calendarHidden = document.getElementById('exitDateCalendar');
		var parkingEntry = $$('#entryDate','#entryMonth','#entryTime');
		var parkingEntry = $$('#dd','#dmy','#t', '#entryDateCalendar');
		
		var errors = $$('.error');	
		var anchor = $$('.anchor');	
		
		stretchers.setStyles({'height': '0', 'overflow': 'hidden'});
		disclaimerHide.setStyles({'height': '0', 'overflow': 'hidden'});	
		parkingHidden.setStyles({'height': '0', 'overflow': 'hidden'});
		if(calendarHidden){
			calendarHidden.className = 'calendarHidden';
		}
		errors.setStyles({'height': '0', 'overflow': 'hidden'});
	
		window.addEvent('load', function(){		
			
			parkingEntry.addEvents({
		'focus': function() {
			parkingHidden.setStyles({'height': '69', 'overflow': 'visible'});
			calendarHidden.className = 'calendar';
			var parking = document.getElementById('parking');
			parking.className  = 'parkingExtra';
		}
	})
			
		anchor.each(function(anchor, i){
				anchor.setAttribute('href','#anchor')
	
			});	
					
		toggler.each(function(toggler, i){
				toggler.color = toggler.getStyle('background-color');
				toggler.$tmp.first = toggler.getFirst();
			});	
			
			var myAccordion = new Accordion(toggler, stretchers, {			
				'opacity': true,			
				'start': true,			
				'transition': Fx.Transitions.Circ.easeOut,
				'alwaysHide' : true,
				
				onActive: function(toggler){
					toggler.$tmp.first.setStyle('border-top', '1px dotted #AFACAC');				
					toggler.$tmp.first.className = 'close';
				},
			
				onBackground: function(toggler){
					//toggler.setStyle('background-color', toggler.color).$tmp.first.setStyle('color', '#222');
					toggler.setStyle('background-color', toggler.color); 
					toggler.$tmp.first.setStyle('border-top', 'none');
					toggler.$tmp.first.className = 'normal';					
				}
			});	
			
			if(window.setWeatherAccordion && (typeof window.setWeatherAccordion=='function')) {
				setWeatherAccordion(myAccordion);
			}
			
			togglerDisclaimer.each(function(togglerDisclaimer, i){
				togglerDisclaimer.$tmp.first = togglerDisclaimer.getFirst();
			});	
			
			var myAccordionDisclaimer = new Accordion(togglerDisclaimer, disclaimerHide, {			
				'opacity': true,			
				'start': true,			
				'transition': Fx.Transitions.Circ.easeOut,
				'alwaysHide' : true,
				
				onActive: function(togglerDisclaimer){					
					togglerDisclaimer.setHTML('Close disclaimer');
					var ul = togglerDisclaimer.parentNode.parentNode;
					if (ul) {
						ul.style.borderTop = '1px dotted #AFACAC'
					}
				},	
				
				onBackground: function(togglerDisclaimer){					
					togglerDisclaimer.setHTML('Disclaimer');							
					var ul = togglerDisclaimer.parentNode.parentNode;
					if (ul) {
						ul.style.borderTop = 'none'
					}													
				}				
			});				
			
					var sandc = document.getElementById('sandc');
					
					var storeFinder = document.getElementById('storeFinder');
					var flightInfo = document.getElementById('flightInfo');
				
					if (sandc) {
						myTabs1 = new mootabs('sandc')				
					}
				
					if (storeFinder) {
						myTabs1 = new mootabs('storeFinder')				
					}
					
					if (flightInfo) {
	
						myTabs1 = new mootabs('flightInfo')								
					}
	
				});			
			};
	};
	
	Setup();	
