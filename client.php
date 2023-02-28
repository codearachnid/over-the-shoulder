<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CLIENT</title>
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

  <div id="tracking">
	  <img src="/assets/cursor.png" id="remote-cursor" class="hidden"/>
  </div>
  
  <div id="room" class="hidden">
	  <h3>
		  <label for="room_key">Room</label>
		  <input type="text" name="room_key" id="room_key" value="" />
	  </h3>
	  <h4>
		  <label for="room_status">Status</label>
		  <input type="text" name="room_status" id="room_status" value="" />
	  </h4>
	  <button id="room_terminate">Close</button>
  </div>
  
  <button id="request_room">Request</button>
  
  <script type="text/javascript" src="/assets/script.client.js" ></script>
  
</body>
</html>