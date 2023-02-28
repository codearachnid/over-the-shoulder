window.tracking = {
	config:{
		interval: 600,	
	},
	actionInterval: null,
	actionPoll: function() {
		var xhr = new XMLHttpRequest();
		var data = new FormData();
		data.append('action', "observer");
		data.append('room_key', document.getElementById("room_key").value);
		data.append('x', window.tracking.mousePosition.x );
		data.append('y', window.tracking.mousePosition.y );
		
		console.log("polling client cursor", window.tracking.mousePosition );
	
		xhr.open("POST", '/api/track.json', true);
	
		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				var r = JSON.parse( this.responseText );
				console.log(r);
				
				if( r.position && "x" in r.position && "y" in r.position ){
					document.getElementById("remote-cursor").classList.remove("hidden");
					document.getElementById("tracking").classList.add("active");
					document.getElementById("remote-cursor").style.left = r.position.x+'px';
					document.getElementById("remote-cursor").style.top = r.position.y+'px';
				} else {
					console.log("no position to track");
					document.getElementById("remote-cursor").classList.add("hidden");
					document.getElementById("tracking").classList.remove("active");
				}
			}
		}
		xhr.send( data );
	},
	mousePosition: {
		x: null,
		y: null,
	},
	mousePositionListener: function( event ){
		if( window.tracking.status ){
			// console.log( 'setting mouse position', event );
			window.tracking.mousePosition = {
				x: event.clientX,
				y: event.clientY,
			};
		}
	},
	statusValue: false,
	// statusListener: function(newStatus) {},
	set status(newStatus) {
		this.statusValue = newStatus;
		this.statusListener(newStatus);
	},
	get status() {
		return this.statusValue;
	},
	statusListener: function(listener){
		this.statusListener = listener;
	}
};


window.tracking.statusListener(function(v) {
  console.log("window.tracking " + v);
  
  // react to status value change
  if( v ){
	document.getElementById("request_room").classList.add("hidden"); // hide room request
	document.getElementById("room").classList.remove("hidden"); // show session details
	
	// setup tracking caller
	window.tracking.actionInterval = setInterval( window.tracking.actionPoll, window.tracking.config.interval);
	
	// setup mouse tracking
	document.getElementById("tracking").addEventListener("mousemove", window.tracking.mousePositionListener);
  } else {
	document.getElementById("request_room").classList.remove("hidden"); // show room request
	document.getElementById("room").classList.add("hidden"); // hide session details
	
	// clear tracking caller
	clearInterval(window.tracking.actionInterval);
	document.getElementById("tracking").removeEventListener("mousemove", window.tracking.mousePositionListener);
  }
  
});

window.tracking.config.interval = 900;


document.getElementById("request_room").addEventListener("click", function(){
	
	document.getElementById("request_room").classList.add("hidden"); // hide room request
	document.getElementById("room").classList.remove("hidden"); // show session details

});

document.getElementById("room_join").addEventListener("click", function(){
	var xhr = new XMLHttpRequest();	  
	  var data = new FormData();
	  data.append('action', "validate");
	  data.append('room_key',document.getElementById("room_key").value);
	  
	  xhr.open("POST", '/api/room.json', true);
	  
	  xhr.onreadystatechange = function () {
		  if (this.readyState == 4 && this.status == 200) {
			  var r = JSON.parse( this.responseText );
			  console.log(r);
			  
			  // document.getElementById("room_key").value = '';
			  document.getElementById("room_status").value = 'tracking';
			  window.tracking.status = true;
		  }
	  }
	  xhr.send( data );
});

// TODO make this work correctly for both
document.getElementById("room_terminate").addEventListener("click", function(){
	window.tracking.status = false;
	document.getElementById("remote-cursor").classList.add("hidden");
	document.getElementById("tracking").classList.remove("active");
	var xhr = new XMLHttpRequest();	  
	  var data = new FormData();
	  data.append('action', "destroy");
	  data.append('room_key',document.getElementById("room_key").value);
	  
	  xhr.open("POST", '/api/room.json', true);
	  
	  xhr.onreadystatechange = function () {
		  if (this.readyState == 4 && this.status == 200) {
			  var r = JSON.parse( this.responseText );
			  console.log(r);
			  
			  document.getElementById("room_key").value = '';
			  document.getElementById("room_status").value = 'closed';
			  window.tracking.status = false;
		  }
	  }
	  xhr.send( data );
});
