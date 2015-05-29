<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Google Maps</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false" type="text/javascript"></script>
  </head>
  <body onunload="GUnload()">

    <div id="map" style="width: 550px; height: 450px"></div>


    <noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b>
      However, it seems JavaScript is either disabled or not supported by your browser.
      To view Google Maps, enable JavaScript by changing your browser options, and then
      try again.
    </noscript>


    <script type="text/javascript">
    //<![CDATA[

    if (GBrowserIsCompatible()) {

      var lastmarker;

      function createInputMarker(point) {
        var marker = new GMarker(point,{draggable:true, icon:G_START_ICON});
        GEvent.addListener(marker, "click", function() {
          lastmarker = marker;
          var lat = lastmarker.getPoint().lat();
        var lng = lastmarker.getPoint().lng();

      var iwform = 'Enter details:<br>'
                  + ' <br>Lat : ' + lat
                  + ' <br>Lng : ' + lng
                 + '<form onsubmit="process(this); return false" action="index.php">'
                 + '  <textarea name="content" rows="5" cols="40"><\/textarea><br>'
         + '  <input type="hidden" name="mode" value="updatestatus" />'
         +' <br>file upload : <input class="btn btn-primary" name="image_url" type="file" />'
        + '<input type="hidden" name="lat" value="'+lat+'">'
      		 + '<input type="hidden" name="lng" value="'+lng+'"+><br>'
         + '  <input type="submit" value="Submit" />'
                 + '<\/form>';

   marker.openInfoWindowHtml(iwform);
        });
        map.addOverlay(marker);
        return marker;
      }



      // == creates a draggable marker with an input form ==

      // == creates a "normal" marker
      function createMarker(point,text) {
        var marker = new GMarker(point);
        GEvent.addListener(marker,"click", function() {
          marker.openInfoWindow(document.createTextNode(text));
        });
        map.addOverlay(marker);
        return marker;
      }

      // == Display the map, with some controls and set the initial location
      var map = new GMap2(document.getElementById("map"),{draggableCursor:"default"});
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());

      map.setCenter(new GLatLng(-6.2198832000,106.7922145000),13);

      // == Listen for map click and add an input marker
      GEvent.addListener(map,"click",function(overlay,point){
        if (!overlay) {
          createInputMarker(point);
        }
      });

      function process(form) {
        // == obtain the data
        var details = form.data.value;
        var lat = lastmarker.getPoint().lat();
        var lng = lastmarker.getPoint().lng();
        var url = "myserver.php?lat=" +lat+ "&lng=" +lng+ "&details="+details;

        // ===== send the data to the server
        GDownloadUrl(url, function(doc) {    });

        // == remove the input marker and replace it with a completed marker
        map.closeInfoWindow();
        var marker = createMarker(lastmarker.getPoint(),details);
        GEvent.trigger(marker,"click");

      }


      // === Define the function thats going to read the stored data ===
      readData = function(doc) {
        // === split the document into lines ===
        lines = doc.split("\n");
        for (var i=0; i<lines.length; i++) {
          if (lines[i].length > 1) {
            // === split each line into parts separated by "|" and use the contents ===
            parts = lines[i].split("|");
            var lat = parseFloat(parts[0]);
            var lng = parseFloat(parts[1]);
            var details = parts[2];
            var point = new GLatLng(lat,lng);
            // create the marker
            var marker = createMarker(point,details);
          }
        }
      }
      // === read data entered by previous users ===
      GDownloadUrl("details.txt", readData);



    }

    // display a warning if the browser was not compatible
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/
    // http://econym.org.uk/gmap/

    //]]>
    </script>
  </body>

</html>




