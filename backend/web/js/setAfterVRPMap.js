// setting marker variable
var markers = [];
var contentDialog = [];

// variable yang digunakan untuk mengghitung vrp
var markerVRP = [];
var arrayDistance = [];
var arrayWeight = [];

var weightSum = 0;

var percentage = 0;
var totalSwap = 0;
var totalTime = 0;
var totalDistance = 0;
var totalCost = 0;

// markers count
var markersCount = [];
var contentDialogCount = [];

var percentageCount = 0;
var totalSwapCount = 0;
var totalTimeCount = 0;
var totalDistanceCount = 0;
var totalCostCount = 0;

var colors = ["red", "green", "orange", "purple", "blue", "red", "green", "orange", "purple", "blue"];
var coastPKM = 1000;

var storeMarker = [];
var storeInformation = [];

var txtSwap = document.getElementById("txtSwap");
var txtTime = document.getElementById("txtTime");
var txtDistance = document.getElementById("txtDistance");
var txtCoast = document.getElementById("txtCoast");

var txtSwapCount = document.getElementById("txtSwapCount");
var txtTimeCount = document.getElementById("txtTimeCount");
var txtDistanceCount = document.getElementById("txtDistanceCount");
var txtCoastCount = document.getElementById("txtCoastCount");

// setting marker direction
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer();

var directionsServiceCount = new google.maps.DirectionsService();
var directionsDisplayCount = new google.maps.DirectionsRenderer();

var centerCoordinates = new google.maps.LatLng(-7.2807707,112.5881513);

var map_asu;
var map_count;

directionsDisplay.setMap(map_asu);
directionsDisplayCount.setMap(map_count)

// ================================== Fetch LatLng Data From MYDB ========================================//

function getAfterExampleOrder(image, name, address, lat, lng){

  storeMarker.push(lat);
  storeMarker.push(lng);

  markerVRP.push(storeMarker);

  storeInformation.push(image);
  storeInformation.push(name);
  storeInformation.push(address);

  arrayWeight.push(0);

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

        markerVRP.push(value.marker);
        arrayWeight.push(parseInt(value.information[3]));

        weightSum = weightSum + parseInt(value.information[3]);

        markersCount.push(value.marker);
        contentDialogCount.push(value.information);
      });
      initializeOrderMapsAfter();
    }
  });
}

// ================================== Inisilisasi dengan Google Maps Marker ========================================//

function initializeOrderMapsAfter() {

  // insialisasi maps

  map_asu = new google.maps.Map(
      document.getElementById("map_before"), {
          center: centerCoordinates,
          zoom: 13,
          mapTypeId: 'roadmap',
      }
  );

  map_count = new google.maps.Map(
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

  var x = 0, y = 0, z = 0;

  timeout(x);
  timeout2(y);

  console.log("sum  = " + weightSum);

  // function makeDistanceArrayY(z){
  //     var newArray = [];
  //     if (z < markerVRP.length) {
  //         int a = 0;
  //         setTimeout(function (){
  //
  //         }, 200);
  //     }
  // }
  //
  // function makeDistanceArrayX(a){
  //     if (z < markerVRP.length) {
  //         setTimeout(function (){
  //         }, 200);
  //     }else {
  //
  //     }
  // }

  isiDistanceArray();

  function isiDistanceArray(){
      for(var i = 0; i < markerVRP.length; i++){
          var newArray = [];
          for (var y = 0; y < markerVRP.length; y++) {
              newArray.push(getDistance(markerVRP[i], markerVRP[y]));
          }
          arrayDistance.push(newArray);
      }
      var text = "";
      for(var i = 0; i < markerVRP.length; i++){
          var newArray = [];
          for (var y = 0; y < markerVRP.length; y++) {
            text = text + " " + arrayDistance[i][y];
          }
          text = text + " berat : " +  arrayWeight[i] + "\n";
      }
      $('#txtaArray').text(text);
  }

  //display dan menghitung route marker before menggunakan google maps api

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

              console.log(color);

              getRouteBefore(storeMarker, markers[x], color);
              getRoutePulangBefore(markers[x], storeMarker, color);

              bounds.extend(marker.position);

              // Allow each marker to have an info window
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                      infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=" + contentDialog[x][0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + contentDialog[x][1] +"</b></h4><p style='margin-top:-10px;'>" + contentDialog[x][2] + "</p><p style='margin-top:-10px;'>Berat Order : " + contentDialog[x][3] + " Kg | Biaya : Rp. " + contentDialog[x][4] + "</p></div>");
                      infoWindow.open(map_asu, marker);
                  }
              })(marker, i));
              x++;
              timeout(x);
              totalSwap++;
              percentage = percentage + (100 / markers.length);
              document.getElementById("txtSwap").innerHTML = percentage + " % | Swap/Turn : " + totalSwap;
          }, 2500);
      }
  }

  //display dan menghitung route marker after menggunakan google maps api

  function timeout2(y){
      if (y < markersCount.length) {
          setTimeout(function(){
              console.log(y);
              var position = new google.maps.LatLng(markersCount[y][0], markersCount[y][1]);
              // bounds.extend(position);
              marker = new google.maps.Marker({
                  position: position,
                  map: map_count,
                  icon: imageGreenOrder,
              });
              var color = colors[y];

              console.log(color);

              getRouteAfter(storeMarker, markersCount[y], color);
              getRoutePulangAfter(markersCount[y], storeMarker, color);

              bounds.extend(marker.position);

              // Allow each marker to have an info window
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                      infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=" + contentDialogCount[y][0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + contentDialogCount[y][1] +"</b></h4><p style='margin-top:-10px;'>" + contentDialogCount[y][2] + "</p><p style='margin-top:-10px;'>Berat Order : " + contentDialogCount[y][3] + " Kg | Biaya : Rp. " + contentDialogCount[y][4] + "</p></div>");
                      infoWindow.open(map_count, marker);
                  }
              })(marker, i));
              y++;
              timeout2(y);
          }, 2500);
      }
  }

  //display marker store pada google maps api pada masing maps after dan before

  var position = new google.maps.LatLng(storeMarker[0], storeMarker[1]);
  // bounds.extend(position);
  marker = new google.maps.Marker({
      position: position,
      map: map_asu,
      icon: storeMarkerImage
  });

  marker2 = new google.maps.Marker({
      position: position,
      map: map_count,
      icon: storeMarkerImage
  });

  bounds.extend(marker.position);

  // Allow each marker to have an info window
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
          infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=http://localhost/jualikan.id/" + storeInformation[0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + storeInformation[1] +"</b></h4><p style='margin-top:-10px;'>" + storeInformation[2] + "</p></div>");
          infoWindow.open(map_asu, marker);
      }
  })(marker, i));

  google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
          infoWindow.setContent("<div style='float:left; margin-bottom:0px;'><img src=http://localhost/jualikan.id/" + storeInformation[0] + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;'><h4 style='margin-top:0px;'><b>" + storeInformation[1] +"</b></h4><p style='margin-top:-10px;'>" + storeInformation[2] + "</p></div>");
          infoWindow.open(map_count, marker2);
      }
  })(marker, i));

  map_asu.fitBounds(bounds);
  map_count.fitBounds(bounds);

}

// ================================== Mencari route menggunakan maps api ========================================//

//get
function getRouteBefore(awal, akhir, color) {
    console.log("Berangkat Before");
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
            var totalDistance1 = 0;
            var totalDuration = 0;
            var legs = response.routes[0].legs;
            for(var i=0; i<legs.length; ++i) {
                totalDistance1 += legs[i].distance.value;
                totalDuration += legs[i].duration.value;
            }
            totalDistance += totalDistance1;
            totalTime += totalDuration;
            $('#txtDistance').text("Distance : " + (totalDistance / 1000) + " KM");
            $('#txtTime').text("Time : " + (Math.round((totalTime / 60) * 100) / 100) + " menit");
            $('#txtCoast').text("Coast : Rp. " + ((totalDistance / 1000) * coastPKM));
        }else {
            console.log("Berangkat Before Failed");

            // window.alert('Directions request failed due to ' + status);
        }
    });
}

// ================================== Mencari route menggunakan maps api ========================================//

function getRoutePulangBefore(awal, akhir, color) {
    console.log("Pulang Before");

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
                  strokeColor: color,
                  strokeOpacity: 0.5,
                },
                suppressMarkers: true
            });
            var totalDistance1 = 0;
            var totalDuration = 0;
            var legs = response.routes[0].legs;
            for(var i=0; i<legs.length; ++i) {
                totalDistance1 += legs[i].distance.value;
                totalDuration += legs[i].duration.value;
            }
            totalDistance += totalDistance1;
            totalTime += totalDuration;
            $('#txtDistance').text("Distance : " + (totalDistance / 1000) + " KM");
            $('#txtTime').text("Time : " + (Math.round((totalTime / 60) * 100) / 100) + " menit");
            $('#txtCoast').text("Coast : Rp. " + ((totalDistance / 1000) * coastPKM));
        }else {
            // console.log(status + " pulang");
            // window.alert('Directions request failed due to ' + status);
        }
    });
}

// ================================== Mencari route menggunakan maps api ========================================//

function getRouteAfter(awal, akhir, color) {

    var origin = new google.maps.LatLng(awal[0], awal[1]);
    var destination = new google.maps.LatLng(akhir[0], akhir[1]);

    console.log(awal[0], awal[1]);
    console.log(akhir[0], akhir[1]);

    directionsServiceCount.route({
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
    }, function (response, status){
        if (status == google.maps.DirectionsStatus.OK) {
            console.log("Berangkat After");
            var directionsRenderer1 = new google.maps.DirectionsRenderer({
                directions: response,
                routeIndex: 0,
                map: map_count,
                polylineOptions: {
                  strokeColor: color
                },
                suppressMarkers: true
            });
        }else {
            console.log("Berangkat After Failed");

            // window.alert('Directions request failed due to ' + status);
        }
    });
}

// ================================== Mencari route menggunakan maps api ========================================//

function getRoutePulangAfter(awal, akhir, color) {

    var origin = new google.maps.LatLng(awal[0], awal[1]);
    var destination = new google.maps.LatLng(akhir[0], akhir[1]);

    directionsServiceCount.route({
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
    }, function (response, status){
        if (status == google.maps.DirectionsStatus.OK) {
          console.log("Pulang After");
            var directionsRenderer1 = new google.maps.DirectionsRenderer({
                directions: response,
                routeIndex: 0,
                map: map_count,
                polylineOptions: {
                  strokeColor: color,
                  strokeOpacity: 0.5,
                },
                suppressMarkers: true
            });
        }else {
          console.log("Pulang After Failed");
            // window.alert('Directions request failed due to ' + status);
        }
    });
}

// ================================== Menghitung jarak antar marker menggunakan converter ========================================//

var rad = function(x) {
  return x * Math.PI / 180;
};

function getDistance(p1, p2) {
    var R = 6378137; // Earth’s mean radius in meter
    if ((p2[0] == p1[0]) && (p2[1] == p1[1])) {
        return 0;
    }else {
        var dLat = rad(p2[0] - p1[0]);
        var dLong = rad(p2[1] - p1[1]);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(p1[0])) * Math.cos(rad(p2[0])) *
                Math.sin(dLong / 2) * Math.sin(dLong / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;
        return d; // returns the distance in meter
    }
};
