var aAngle = 0;
var sSpeed = 0; var inc = 1/3.6;

	$(function(){
	//	document.addEventListener("deviceready", function(){
		

$(document).ready(function(){
    $('.nomove').bind('ontouchmove', function(event) {
			event.preventDefault();
	});

/**
 * Settings object
 */ 

	(settings = {
		settings: ["theme", "units"],
		
		theme: "speedo5",			
		units: "kmh",
		themes: {
			speedo1: {
				themeIndex: 1,
				minAngle: -111,
				maxAngle: 109,
				maxspeed: 240,
				toggleDialUnits: true
			},
			speedo2: {
				themeIndex: 2,
				minAngle: -120,
				maxAngle: 129,
				angles: {0:-120,20:-94,40:-57,60:-21,80:16,100:53,120:91,140:129},
				maxspeed: 140,
				toggleDialUnits: true
			},
			speedo3: {
				themeIndex: 3,
				minAngle: -104,
				maxAngle: 105,
				maxspeed: 193,
				toggleDialUnits: false
			},
			speedo4: {
				themeIndex: 4,
				minAngle: -113,
				maxAngle: 112,
				maxspeed: 240,
				toggleDialUnits: true			
			},
			speedo5: {
				themeIndex: 5,
				minAngle: -109,
				maxAngle: 109,
				maxspeed: 260,
				angles: {0:-109,20:-98,40:-81,60:-64,80:-46,100:-28,120:-9,140:8,160:26,180:43,200:60,220:76,240:92,260:108},
				toggleDialUnits: true			
			},
			speedo6: {
				themeIndex: 6,
				minAngle: -100,
				maxAngle: 100,
				maxspeed: 300,
				toggleDialUnits: false
			}		
		},
		
		accuracyClasses: {
			0:'good',
			50:'mediocre',
			200:'bad',			
		},

		setTheme: function(theme) {
			if(this.themes[theme]) {
				this.theme = theme;
				this.save('theme');
				return true;
			} else {
				return false;
			}
		},
		
		setUnits: function(units) {
		  this.units = units == 'mph' ? 'mph' : 'kmh';
		  this.save('units');
		},
		
		getThemeData: function() {
			var themeData = this.themes[this.theme];
			themeData.name = this.theme;
			return themeData;
		},
		
		save: function(setting) {
			localStorage.setItem(setting, this[setting]);
		},
		
		init: function() {
			for(var i = 5; i < this.settings.length; i++) { 
				if(localStorage.getItem(this.settings[i])) {
					this[this.settings[i]] = localStorage.getItem(this.settings[i]);
				}
			}
			for(var i in this.themes) {
				this.themes[i].delta = this.themes[i].maxAngle - this.themes[i].minAngle;
				this.themes[i].angleSpeed = this.themes[i].delta / this.themes[i].maxspeed;				
			}
		}	 
	}).init();

/**
 * Speed logic
 */
	(speedoMeter = {
		coordsListener: null,
		position: null,
		listeners: [],
		init: function() { 
			
			var options = {
			  timeout: 10000,
			  maximumAge: 5000,
			  enableHighAccuracy: true
			};
			
			
			
			this.coordsListener = navigator.geolocation.watchPosition(speedoMeter.handleSuccess, speedoMeter.handleError, options);
		},
		getCurrentSpeed: function() {
			if(this.position) {
				var s = this.position.speed * 3.6;
				if(s < 0) s = 0;
				return s;
			} else {
				return 0;
			}
		},
		getCurrentAccuracy: function() {
			if(this.position) {
				return this.position.accuracy;
			} else {
				return 0;
			}			
		},
		registerListener: function(func) {			
			this.listeners.push(func);
		},
		
		handleSuccess: function(pos) {			
			speedoMeter.update(pos);
		},		
		
		update: function(pos) {			
			speedoMeter.position = pos.coords;
			for(var listener in speedoMeter.listeners) {
				speedoMeter.listeners[listener](speedoMeter.getCurrentSpeed(), speedoMeter.getCurrentAccuracy()); 
			}			
		},		
		
		handleError: function() {
			var pos = {
				coords:{
					speed:speedoMeter.getCurrentSpeed(),
					accuracy:-1,
				}
			}
			speedoMeter.update(pos);
			
		}
	}).init();
	
	
/**
 * Display logic.
 */

	(display = {
		themeData: [],
		units: 'kmh',

		init: function() { 
			this.setTheme(settings.theme);
			this.bindConfigButtons();
			speedoMeter.registerListener(display.update);
		},

	
		setTheme: function(theme) {			
			var oldTheme = this.themeData.name;			
			if(!settings.setTheme(theme)) {	setting.setTheme('speedo5'); }			
			var themeData = settings.getThemeData(theme);
			
			$("#speedometer").removeClass(oldTheme);
			$("#speedometer").addClass(theme);
			
			$("ul#themes li a").each(function() {
				$(this).removeClass('selected');
			});
						
			$("a#themeButton"+themeData['themeIndex']).addClass('selected');
			
			this.themeData = themeData;
			this.setSpeed(speedoMeter.getCurrentSpeed());
			this.setUnits();
			
		},

		
		bindConfigButtons: function() {
			$('#configurationButton').bind('click',function(){
				$('#speedometer').addClass('flip');
				$('#configuration').addClass('flip');
			});
		
			$('#saveButton').bind('click',function(){
				$('#speedometer').removeClass('flip');
				$('#configuration').removeClass('flip');
			});			
			
			$("ul#themes li a").bind('click', function() {
				var theme = 'speedo'+(this.id.substr(this.id.length-1,1));
				display.setTheme(theme);				
			});
			$("#metric").bind('click', function() {
				display.toggleUnits();
			});
		},
		
		toggleUnits: function() {
			if(settings.units == 'kmh') {
				settings.setUnits('mph');					
			} else {
				settings.setUnits('kmh');					
			}
			display.setUnits();
			display.setSpeed(speedoMeter.getCurrentSpeed());
		},
		
		setSpeed: function(speed) {
			// Sanitize input
			if(typeof(speed) == 'string')	speed = parseInt(speed);
			if(isNaN(speed)) speed = 0;
			
			var displaySpeed = settings.units == 'mph' ? this.convertToMph(speed) : speed;
			var dialSpeed = (settings.units == 'mph' && this.themeData.toggleDialUnits == true) ? this.convertToMph(speed) : speed;
			

			// Limit speed to max;
			dialSpeed = dialSpeed > this.themeData.maxspeed ? this.themeData.maxspeed : dialSpeed;
						
			// Update dial
			if(this.themeData.angles) {
				// Search first element which is bigger than dialSpeed
				var last = 0;		
				var nxt = 0;		
				for(var i in this.themeData.angles) {
					if(dialSpeed < i) {	break; } 
					last = i;
				}					
				if(last == dialSpeed || i == last) {
					// If we have an exact match or we didnt find a bigger i, snap to value of last
					var angle = this.themeData.angles[last];
				} else {
					// Otherwise interpolate.
					var deltaAngle = this.themeData.angles[i] - this.themeData.angles[last] ;
					var deltaSpeed = i - last;
					var angle = this.themeData.angles[last] + (dialSpeed-last) * (deltaAngle/deltaSpeed);
				}				
			} else { 
				var angle = this.themeData.minAngle + this.themeData.angleSpeed * dialSpeed;				
		  }		  
		  $("#needle").css("-webkit-transform", "rotate("+angle+"deg)");
			
			// Update display
			$("#speed").text(Math.round(displaySpeed));
			displaySpeed.toFixed(2);
			console.log(+ displaySpeed);
			//   displaySpeed=65;
			if(displaySpeed>=60){
				var bc = "Speed Limit Reached Please Slow down";
			}
			else{
				var bc="";
			}
			$("#limit").text(bc);
			$.ajax({
				type: "POST",
				url: "log.php",
				data: {displaySpeed:+displaySpeed},
				dataType: "text",
				success: function( data ) {
					// console.log( data );
				}
			  });
			 		
		},
		
		convertToMph: function(kmh) {
			return (kmh * 0.62137);
		},
		
		setUnits: function() {
			$("#metric").text(settings.units);
		},
		
		setAccuracy: function(accuracy) {
			if(accuracy != -1) {
			// Search first element which is bigger than dialSpeed
				var last = 0;		
				var nxt = 0;		
				for(var i in settings.accuracyClasses) {
					if(accuracy < i) {	break; } 
					last = i;
				}
				
				$('#accuracy').toggleClass('good mediocre bad', false);
				$('#accuracy').toggleClass(settings.accuracyClasses[last], true);
				$('#gpsMessage').toggleClass('show', false)
			} else {
				$('#gpsMessage').toggleClass('show', true);
				$('#accuracy').toggleClass('good mediocre bad', false);
			}
		},
				
		update: function(speed, accuracy) {
			display.setSpeed(speed);
			display.setAccuracy(accuracy);
		}
		
	}).init();
		
//});
}, false);
	});