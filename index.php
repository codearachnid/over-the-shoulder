<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>TRACK</title>
</head>

<body>


  <a href="/client.php">CLIENT</a>
  <a href="/observer.php">OBSERVER</a>
<!-- 

  <div id="tracking" onmousemove="getCursorPosition(event)"></div>

  <label for="room">Room</label>
  <input type="text" name="room" id="room" value="" />
  <label for="m_x">Mouse X</label>
  <input type="text" name="m_x" id="m_x" value="" />
  <label for="m_y">Mouse Y</label>
  <input type="text" name="m_y" id="m_y" value="" />
  <button id="track">tracking</button>
  
  

  <script type="text/javascript">
    
    var tracking = false;
    var interval = 900;
    
    function getCursorPosition(event) {
      if( tracking ){
        document.getElementById("m_x").value = event.clientX;
        document.getElementById("m_y").value = event.clientY;
      }

    }
    
    
    document.getElementById("track").addEventListener("click", function (){
      
      tracking = tracking ? false : true;
      console.log('toggle tracking', tracking);
      
      if( tracking ){
        document.getElementById("tracking").classList.add("active");
      } else {
        document.getElementById("tracking").classList.remove("active");
      }
      
    });
    
    
    function run() {
        var xhr = new XMLHttpRequest();
        var data = new FormData();
        data.append('x', document.getElementById("m_x").value);
        data.append('y', document.getElementById("m_y").value);
        data.append('r', document.getElementById("room").value);

        xhr.open("POST", '/api/track.json', true);

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        }
        xhr.send( data );
    }
    
    
    setInterval(function() {
      if( tracking ){
        console.log('track position');
        run();
      }
    }, interval);
  </script> -->
</body>

</html>