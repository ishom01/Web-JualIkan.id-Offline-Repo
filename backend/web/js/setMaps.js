var map;

console.log(location.host);

var server = "http://" + location.host + "/jualikan.id/";

// setting marker variable
var markers = [];
var contentDialog = [];
var markerStats = [];

// setting marker direction
var source, destination;
var directionsService = new google.maps.DirectionsService();

// getDistributionAll();

function getDistributionAll(){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getDistributionAll.php",
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initialize();
    }
  });
}

function getKoperasiById(id){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getKoperasiById.php?id=" + id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initialize();
    }
  });
}

function getKabehOrder(id){
  console.log(id);
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getAllOrder2.php?id=" + id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initializeOrderMaps();
    }
  });
}

function getDelivery(id){
  console.log(id);
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getDeliveryAll.php?id=" + id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initializeOrderMaps();
    }
  });
}

function getDeliveryHariIni(id){
  console.log(id);
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getDeliveryHariIni.php?id=" + id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initializeOrderMaps();
    }
  });
}

function getDeliveryBulanIni(id){
  console.log(id);
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getDeliveryBulanIni.php?id=" + id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      console.log(markers.length);
      initializeOrderMaps();
    }
  });
}

function getOrderHariIni(id){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getOrderHariIni.php?id="+ id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initializeOrderMaps();
    }
  });
}

function getOrderBulanIni(id){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getOrderBulanIni.php?id=" + id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initializeOrderMaps();
    }
  });
}

function getDetailOrder(id){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getAllOrder3.php?id="+id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initializeOrderMaps();
    }
  });
}

function getKoperasi(){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getKoperasi.php",
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initialize();
    }
  });
}

function getDirectionFromOrder(id){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getOrderDirections.php?id="+id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initialize();
      getRoute();
    }
  });
}

function getDistributionAandOrderAll(){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getDistributionAndOrder.php",
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initialize();
    }
  });
}

function getDistributionById(id){
  $.ajax({
    type  : "GET",
    data  : "",
    url   : server + "backend/web/api/getDistributionById.php?id="+id,
    success : function(result){
      var resultObj = JSON.parse(result);
      $.each(resultObj, function(key, value){
        console.log(value.marker);
        markers.push(value.marker);
        contentDialog.push(value.dialog);
        markerStats.push(value.status);
      });
      initialize();
    }
  });
}

function initialize() {
  var centerCoordinates = new google.maps.LatLng(-7.2807707,112.5881513);
  var mapOptions = {
      mapTypeId: 'roadmap',
      center: centerCoordinates,
      zoom: 10
  };

  // Display a map on the page
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

  // Display multiple markers on a map
  var infoWindow = new google.maps.InfoWindow(), marker, i;
  var bounds = new google.maps.LatLngBounds();

  // Loop through our array of markers & place each one on the map
  var imageCompany = server + "frontend/web/img/icon_company.png";
  var imageOrder = server + "frontend/web/img/icon_user.png";
  // console.log(image);

  var icons = {
      1 : {
          icon: imageCompany
      },
      2 : {
          icon: imageOrder
      }
  };

  for( i = 0; i < markers.length; i++ ) {
      // console.log(markers[1]);
      var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
      // bounds.extend(position);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          icon: icons[markerStats[i]].icon
          // icon: imageCompany
          // title: markers[i][0]
      });

      bounds.extend(marker.position);

      // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent("<b>" + contentDialog[i][0] + "</b><br/>" + contentDialog[i][1]);
              infoWindow.open(map, marker);
          }
      })(marker, i));
  }

  map.fitBounds(bounds);
}

function initializeOrderMaps() {
  var centerCoordinates = new google.maps.LatLng(-7.2807707,112.5881513);
  var mapOptions = {
      mapTypeId: 'roadmap',
      center: centerCoordinates,
      zoom: 10
  };

  // Display a map on the page
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

  if (markers.length == 0) {
      document.getElementById("map_canvas").style.height = "0px";
      document.getElementById("map_canvas").style.marginTop = "0px";
  }

  // Display multiple markers on a map
  var infoWindow = new google.maps.InfoWindow(), marker, i;
  var bounds = new google.maps.LatLngBounds();

  // Loop through our array of markers & place each one on the map
  var imageGreenOrder = server + "frontend/web/img/order_green_marker.png";
  var imageOrangeOrder = server + "frontend/web/img/order_orange_marker.png";
  var imageBlueOrder = server + "frontend/web/img/order_blue_marker.png";
  var imageRedOrder = server + "frontend/web/img/order_red_marker.png";
  // console.log(image);

  var icons = {
      0 : {
          icon: imageOrangeOrder
      },
      1 : {
          icon: imageBlueOrder
      },
      2 : {
          icon: imageBlueOrder
      },
      3 : {
          icon: imageGreenOrder
      },
      5 : {
          icon: imageRedOrder
      }
  };

  for( i = 0; i < markers.length; i++ ) {
      console.log(markers[1]);
      var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
      // bounds.extend(position);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          icon: icons[markerStats[i]].icon
          // icon: imageCompany
          // title: markers[i][0]
      });

      bounds.extend(marker.position);

      // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
              infoWindow.setContent("<b>" + contentDialog[i][0] + "</b><br/>" + contentDialog[i][1]);
              infoWindow.open(map, marker);
          }
      })(marker, i));
  }

  map.fitBounds(bounds);
}



//get
function getRoute() {
    var directionsDisplay;
    directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
    directionsDisplay.setMap(map);
    // directionsDisplay.setPanel(document.getElementById('dvPanel'));

    //*********DIRECTIONS AND ROUTE**********************//
    source = new google.maps.LatLng(markers[1][0], markers[1][1]);
    destination = new google.maps.LatLng(markers[0][0], markers[0][1]);

    var request = {
        origin: source,
        destination: destination,
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
