<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>OBSERVER</title>
  <link rel="stylesheet" href="/assets/style.css">
  <style>
    #room input{
      border:1px solid #ccc;
      background: #fff;
    }
    #room button{
      width: 46%;
    }
    #room #room_join{
      margin-right:6%;
    }
  </style>
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
    <button id="room_join">Join</button>
    <button id="room_terminate">Close</button>
  </div>
  
  <button id="request_room">Request</button>
  
  <script type="text/javascript" src="/assets/script.observer.js" ></script>
  
</body>
</html>