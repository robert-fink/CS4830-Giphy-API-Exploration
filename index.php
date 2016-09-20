<!DOCTYPE html>

<script>
function getGifs() {

  document.getElementById("statusBar").innerHTML = "Loading...";

  var images = document.getElementsByTagName('img');
  var length = images.length;
  var searchReq = document.getElementById("searchReq").value;
  var xhttp = new XMLHttpRequest();

  for (i=0; i<length; ++i){
    images[0].parentNode.removeChild(images[0]);
  }

  xhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {

     document.getElementById("statusBar").innerHTML = "Click an image to view the Gif";

     var JSONresponse = this.responseText;
     var obj = JSON.parse(JSONresponse);
     var length = Object.keys(obj.data).length;

     for (i=0; i<length; ++i){
       var image = document.createElement("IMG");
       var link = document.createElement("A");

       image.setAttribute("class", "img_result");
       link.href = obj.data[i].bitly_gif_url;
       image.src = obj.data[i].images.fixed_width_still.url;
       link.appendChild(image);
       document.body.appendChild(link);
     }

    }
  };
  xhttp.open("GET", "http://api.giphy.com/v1/gifs/search?q=" + searchReq + "&api_key=dc6zaTOxFJmzC ", true);
  xhttp.send();
}
</script>

<html>

<head>
  <title>Exploration 1 Gif Search Engine</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
    echo "<h1>A Gif Search Engine Powered by Giphy API</h1>";
  ?>
  <form onAction="javascript:getGifs()">
  <input type='text' id='searchReq' placeholder='space cats, etc.'>
  <button type='button' onclick='getGifs()'>Search</button>
</form>
  <div id="results"><h3 id="statusBar">Search for gifs!</h3></div>

</body>

</html>
