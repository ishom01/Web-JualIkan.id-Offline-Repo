// setting marker variable
var markers = [];
var contentDialog = [];

var colors = ["red", "green", "orange", "yellow", "blue", "red", "green", "orange", "yellow", "blue"];

var storeMarker = [];
var storeInformation = [];

// setting marker direction
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer();

var centerCoordinates = new google.maps.LatLng(-7.2807707,112.5881513);

var map_asu;

directionsDisplay.setMap(map_asu);

// ================================== Fetch Maps API ========================================//

function getAfterExampleOrder(image, name, address, lat, lng){

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
      initializeOrderMapsAfter();
    }
  });
}

function initializeOrderMapsAfter() {

  map_asu = new google.maps.Map(
      document.getElementById("map_result"), {
          center: centerCoordinates,
          zoom: 13,
          mapTypeId: 'roadmap',
      }
  );

  // Display multiple markers on a map
  var infoWindow = new google.maps.InfoWindow(), marker, i;
  var bounds = new google.maps.LatLngBounds();

  // Loop through our array of markers & place each one on the map
  var imageGreenOrder = "http://localhost/jualikan.id/frontend/web/img/order_green_marker.png";
  var storeMarkerImage = "http://localhost/jualikan.id/frontend/web/img/icon_company.png";
  // console.log(image);

  var x = 0;

  timeout(x);

  function timeout(x){
      if (x < markers.length) {
          setTimeout(function(){
              console.log(x);
              var position = new google.maps.LatLng(markers[x][0], markers[x][1]);
              // bounds.extend(position);
              marker = new google.maps.Marker({
                  position: position,
                  map: map_asu,
                  icon: imageGreenOrder,
              });
              var color = colors[x];

              getRouteAfter(storeMarker, markers[x], color);
              getRoutePulangAfter(markers[x], storeMarker, color);

              bounds.extend(marker.position);

              // Allow each marker to have an info window
              google.maps.event.addListener(marker, 'click', (function(marker, x) {
                  return function() {
                      infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=" + contentDialog[x][0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + contentDialog[x][1] +"</b></h4><p style='margin-top:-10px;'>" + contentDialog[x][2] + "</p><p style='margin-top:-10px;'>Berat Order : " + contentDialog[x][3] + " Kg | Biaya : Rp. " + contentDialog[x][4] + "</p></div>");
                      infoWindow.open(map_asu, marker);
                  }
              })(marker, i));
              x++;
              timeout(x);
          }, 2000);
      }
  }
  //
  // for( i = 0; i < markers.length; i++ ) {
  //     // console.log(markers[1]);
  //
  // }

  var position = new google.maps.LatLng(storeMarker[0], storeMarker[1]);
  // bounds.extend(position);
  marker = new google.maps.Marker({
      position: position,
      map: map_asu,
      icon: storeMarkerImage
      // icon: imageCompany
      // title: markers[i][0]
  });

  bounds.extend(marker.position);

  // Allow each marker to have an info window
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
          infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=http://localhost/jualikan.id/" + storeInformation[0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + storeInformation[1] +"</b></h4><p style='margin-top:-10px;'>" + storeInformation[2] + "</p></div>");
          infoWindow.open(map_asu, marker);
      }
  })(marker, i));

  map_asu.fitBounds(bounds);

}

//get
function getRouteAfter(awal, akhir, color) {
    var origin = new google.maps.LatLng(awal[0], awal[1]);
    var destination = new google.maps.LatLng(akhir[0], akhir[1]);

    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
    }, function (response, status){
        if (status == google.maps.DirectionsStatus.OK) {
            var directionsRenderer1 = new google.maps.DirectionsRenderer({
                directions: response,
                routeIndex: 0,
                map: map_asu,
                polylineOptions: {
                  strokeColor: color
                },
                suppressMarkers: true
            });
        }else {
            // window.alert('Directions request failed due to ' + status);
        }
    });
}

function getRoutePulangAfter(awal, akhir, color) {
    var origin = new google.maps.LatLng(awal[0], awal[1]);
    var destination = new google.maps.LatLng(akhir[0], akhir[1]);

    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
    }, function (response, status){
        if (status == google.maps.DirectionsStatus.OK) {
            var directionsRenderer1 = new google.maps.DirectionsRenderer({
                directions: response,
                routeIndex: 0,
                map: map_asu,
                polylineOptions: {
                  strokeColor: color
                },
                suppressMarkers: true
            });
        }else {
            // console.log(status + " pulang");
            // window.alert('Directions request failed due to ' + status);
        }
    });
}
