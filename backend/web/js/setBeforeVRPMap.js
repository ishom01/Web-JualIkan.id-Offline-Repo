var map;

// setting marker variable
var markers = [];
var contentDialog = [];

var colors = ["red", "green", "orange", "yellow", "blue", "pink", "purple"];

var storeMarker = [];
var storeInformation = [];

// setting marker direction
var source, destination;
var directionsService = new google.maps.DirectionsService();

// ================================== Fetch Maps API ========================================//

function getBeforeExampleOrder(image, name, address, lat, lng){

  storeMarker.push(lat);
  storeMarker.push(lng);

  storeInformation.push(image);
  storeInformation.push(name);
  storeInformation.push(address);

  $.ajax({
    type  : "GET",
    data  : "",
    url   : "http://localhost/jualikan.id/backend/web/api/getExampleOrder.php",
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.information);
      });
      initializeOrderMapsBefore();
    }
  });
}

function initializeOrderMapsBefore() {
  var centerCoordinates = new google.maps.LatLng(-7.2807707,112.5881513);
  var mapOptions = {
      mapTypeId: 'roadmap',
      center: centerCoordinates,
      zoom: 10
  };

  // Display a map on the page
  map = new google.maps.Map(document.getElementById("map_before"), mapOptions);

  // Display multiple markers on a map
  var infoWindow = new google.maps.InfoWindow(), marker, i;
  var bounds = new google.maps.LatLngBounds();

  // Loop through our array of markers & place each one on the map
  var imageGreenOrder = "http://localhost/jualikan.id/frontend/web/img/order_green_marker.png";
  var storeMarkerImage = "http://localhost/jualikan.id/frontend/web/img/icon_company.png";
  // console.log(image);

  for( i = 0; i < markers.length; i++ ) {
      // console.log(markers[1]);
      var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
      // bounds.extend(position);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          icon: imageGreenOrder,
      });
      var color = colors[i];
      getRouteBefore(storeMarker, markers[i], color);
      getRoutePulangBefore(markers[i], storeMarker, color);

      bounds.extend(marker.position);

      // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=" + contentDialog[i][0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + contentDialog[i][1] +"</b></h4><p style='margin-top:-10px;'>" + contentDialog[i][2] + "</p><p style='margin-top:-10px;'>Berat Order : " + contentDialog[i][3] + " Kg | Biaya : Rp. " + contentDialog[i][4] + "</p></div>");
              infoWindow.open(map, marker);
          }
      })(marker, i));
  }

  var position = new google.maps.LatLng(storeMarker[0], storeMarker[1]);
  // bounds.extend(position);
  marker = new google.maps.Marker({
      position: position,
      map: map,
      icon: storeMarkerImage
      // icon: imageCompany
      // title: markers[i][0]
  });

  bounds.extend(marker.position);

  // Allow each marker to have an info window
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
          infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=http://localhost/jualikan.id/" + storeInformation[0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + storeInformation[1] +"</b></h4><p style='margin-top:-10px;'>" + storeInformation[2] + "</p></div>");
          infoWindow.open(map, marker);
      }
  })(marker, i));

  map.fitBounds(bounds);

}



//get
function getRouteBefore(awal, akhir, color) {
  var directionsDisplay;
  directionsDisplay = new google.maps.DirectionsRenderer({
      polylineOptions: {
        strokeColor: color
      },
      // suppressInfoWindows: true,
      suppressMarkers: true
  });
  directionsDisplay.setMap(map);
  // directionsDisplay.setPanel(document.getElementById('dvPanel'));

  //*********DIRECTIONS AND ROUTE**********************//
  var source = new google.maps.LatLng(awal[0], awal[1]);
  var destination = new google.maps.LatLng(akhir[0], akhir[1]);

  var request = {
      origin: source,
      destination: destination,
      // waypoints: waypoints,
      travelMode: google.maps.TravelMode.DRIVING
  };

  directionsService.route(request, function (response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
      }
  });

  //*********DISTANCE AND DURATION**********************//
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix({
      origins: [source],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
  }, function (response, status) {
      if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
          var distance = response.rows[0].elements[0].distance.text;
          var duration = response.rows[0].elements[0].duration.text;
          // var dvDistance = document.getElementById("dvDistance");
          // dvDistance.innerHTML = "";
          // dvDistance.innerHTML += "Distance: " + distance + "<br />";
          // dvDistance.innerHTML += "Duration:" + duration;
      } else {
          alert("Unable to find the distance via road.");
      }
  });
}

function getRoutePulangBefore(awal, akhir, color) {
  var directionsDisplay;
  directionsDisplay = new google.maps.DirectionsRenderer({
      polylineOptions: {
        strokeColor: color
      },
      // suppressInfoWindows: true,
      suppressMarkers: true
  });
  directionsDisplay.setMap(map);
  directionsDisplay.setMap(map_asu);
  // directionsDisplay.setPanel(document.getElementById('dvPanel'));

  //*********DIRECTIONS AND ROUTE**********************//
  var source = new google.maps.LatLng(awal[0], awal[1]);
  var destination = new google.maps.LatLng(akhir[0], akhir[1]);

  var request = {
      origin: source,
      destination: destination,
      // waypoints: waypoints,
      travelMode: google.maps.TravelMode.DRIVING
  };

  directionsService.route(request, function (response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
      }
  });

  //*********DISTANCE AND DURATION**********************//
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix({
      origins: [source],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
  }, function (response, status) {
      if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
          var distance = response.rows[0].elements[0].distance.text;
          var duration = response.rows[0].elements[0].duration.text;
          // var dvDistance = document.getElementById("dvDistance");
          // dvDistance.innerHTML = "";
          // dvDistance.innerHTML += "Distance: " + distance + "<br />";
          // dvDistance.innerHTML += "Duration:" + duration;
      } else {
          alert("Unable to find the distance via road.");
      }
  });
}
