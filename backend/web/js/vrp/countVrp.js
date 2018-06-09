
//pemesanan
var arrayLocation = [];
var weightSumOrder = 0;

var server = "http://localhost/";

//driver
var arrayDriver = [];
var weightSumDriver = 0;

//var koperasi
var koperasi;

//var arrayVRP
var arrayVRPDistance = [];
var arrayVRPWeight = [];

var temp = [];
var arrayDistance = [];

var progressbar;
var valuebar;
var width = 0;
var step = 0;

var colors = ["red", "green", "orange", "purple", "blue", "yellow", "pink"];

//=================================== mengambil data dari api ===================================//
function getOrder(koperasi_id, koperasi_image, koperasi_name, koperasi_address, koperasi_lat, koperasi_lng){

  var data = [];
  data.id = 0;
  data.image = koperasi_image;
  data.name = koperasi_name;
  data.address = koperasi_address;
  data.weight = 0;
  data.price = 0;
  data.lat = koperasi_lat;
  data.lng = koperasi_lng;

  arrayLocation.push(data);

  $.ajax({
    type  : "GET",
    data  : "",
    // url   : "http://localhost/jualikan.id/backend/web/api/getExampleOrderData.php?id=" + koperasi_id,
    url   : server + "jualikan.id/backend/web/api/getOrderData.php?id=" + koperasi_id,
    success : function(result){
          var resultObj = JSON.parse(result);
          $.each(resultObj.order, function(key, value){
              var data = [];

              data.id = value.information.id;
              data.image = value.information.image;
              data.name = value.information.username;
              data.address = value.information.address;
              data.weight = value.information.weight;
              data.price = value.information.price;
              data.lat = value.information.lat;
              data.lng = value.information.lng;

              weightSumOrder = weightSumOrder + value.information.weight;

              arrayLocation.push(data);
          });
          $.each(resultObj.driver, function(key, value){
              arrayDriver.push(value);
          });
          koperasi = resultObj.koperasi;
          countDistanceWithGoogleApi();
      }
  });


  console.log(arrayLocation);
}

function countDistanceWithGoogleApi(){

    progressbar = document.getElementById("progressbar");
    valuebar = document.getElementById("valueBar");
    step = 100 / (arrayLocation.length * arrayLocation.length);
    progressbar.style.width = width + '%';

    // displayPesananTable();
    // displayDriverTable();
    // console.log(arrayLocation);
    // console.log(arrayDriver);
    countDistanceY(0,0);
}

// menampilkan pesanan table
function displayPesananTable(){
    var title = document.getElementById('titlepesanan');
    var judul = document.createElement('h3');
    judul.innerHTML = "Tabel data pesanan yang siap dikirim";
    title.appendChild(judul);
    var total_weight = 0;
    var total_distace = 0;
    //start tag tabel
    var body = document.getElementById('pesanan');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    var tbdy = document.createElement('tbody');

    var th = document.createElement('tr');

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "ID Pesanan";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "180px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Nama";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Alamat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "218px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "LatLng";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "80px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Berat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Price";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    for (var i = 1; i < arrayLocation.length; i++) {

        var tr = document.createElement('tr');

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = "ID Order " + arrayLocation[i].id;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayLocation[i].name;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayLocation[i].address;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayLocation[i].lat + " , " + arrayLocation[i].lng;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayLocation[i].weight + " KG";
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = "Rp. " + arrayLocation[i].price;
        td.appendChild(h4)
        tr.appendChild(td)

        total_distace = total_distace + arrayLocation[i].price;
        total_weight = total_weight + arrayLocation[i].weight;

        tbdy.appendChild(tr);
    }

    var th = document.createElement('tr');

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "218px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "80px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = total_weight + " KG";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Rp. " + total_distace;
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    tbl.appendChild(tbdy);
    body.appendChild(tbl)
}

// menampilkan data driver
function displayDriverTable(){
    //start tag tabel
    var total_weight = 0;
    var title = document.getElementById('titledriver');
    var judul = document.createElement('h3');
    judul.innerHTML = "Tabel data driver";
    title.appendChild(judul);

    var body = document.getElementById('driver');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    var tbdy = document.createElement('tbody');

    var th = document.createElement('tr');

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Nama Driver";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "180px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Nama";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Alamat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "218px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "LatLng";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Berat Maks";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    for (var i = 0; i < arrayDriver.length; i++) {

        var tr = document.createElement('tr');

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = "Driver ke-" + arrayDriver[i].id;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayDriver[i].username;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayDriver[i].address;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayDriver[i].lat+" , " +arrayDriver[i].lng;
        td.appendChild(h4)
        tr.appendChild(td)

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayDriver[i].weight+" KG";
        td.appendChild(h4)
        tr.appendChild(td)

        total_weight = total_weight + arrayDriver[i].weight;

        tbdy.appendChild(tr);
    }

    var th = document.createElement('tr');

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "180px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "218px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = total_weight + " KG";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    tbl.appendChild(tbdy);
    body.appendChild(tbl)
}

//rekrusif looping untuk mencari distance antar lokasi
function countDistanceY(x,y){
    if (y < arrayLocation.length) {
        setTimeout(function(){
            getDistance(x,y);
            tambahProgress();
            y++;
            countDistanceY(x,y);
        }, 2400);
    }else{
        x++;
        if (x < arrayLocation.length){
            countDistanceY(x,0);
            // console.log("Doing ? " + x);
        }else {
            //next step
            setTimeout(function(){
                console.log(arrayDistance);
                selesaiMenghitungJarak();
            }, 2400);
        }
    }
}

//digunakan untuk menampilkan progressbar
function tambahProgress(){
    width = width + step;
    progressbar.style.width = width + '%';

    valuebar.style.marginLeft = (width-2.8) + '%';
    valuebar.innerHTML = Math.round(width) + '%';
}

//digunakan untuk selesai menghitung jarak
function selesaiMenghitungJarak(){
    displayTabelLokasi();
    countVRPByDistance();
    countVRPWeight();
}

//digunakan untuk menampilkan data antar jarak lokasi
function displayTabelLokasi(){
    var total_weight =0;

    var title = document.getElementById('titlejarak');
    var judul = document.createElement('h3');
    judul.innerHTML = "Tabel Jarak, Waktu dan Berat antar Pengiriman";
    title.appendChild(judul);

    var body = document.getElementById('jarak');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    var tbdy = document.createElement('tbody');

    //start
    var th = document.createElement('tr');

    //row 1
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "120px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Asal / Tujuan";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    for (var i = 0; i < arrayDistance.length; i++) {
          var td = document.createElement('th');
          var h4 = document.createElement('h4');
          td.style.width = "180px";
          td.style.paddingLeft = "14px";
          td.style.paddingRight = "14px";
          if (i == 0) {
            h4.innerText = "Koperasi";
          }else {
            h4.innerText = "Order " + arrayLocation[i].id;
          }
          h4.style.fontWeight = "bold"
          td.appendChild(h4)
          th.appendChild(td)
    }

    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.width = "180px";
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Weight";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    for (var i = 0; i < arrayDistance.length; i++) {
        var tr = document.createElement('tr');

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        if (i == 0) {
            h4.innerText = "Koperasi";
        }else {
            h4.innerText = "Order-" +arrayLocation[i].id;
        }
        td.appendChild(h4)
        tr.appendChild(td)

        for (var j = 0; j < arrayDistance[i].length; j++) {
            var td = document.createElement('td');
            var h4 = document.createElement('h4');
            td.style.paddingLeft = "14px";
            td.style.paddingRight = "14px";
            if (arrayDistance[i][j].distance/1000 == 0) {
                h4.innerText = "-";
            }else {
                h4.innerText = Math.round(arrayDistance[i][j].distance/1000) + " Km / ";
                h4.innerText += Math.round(arrayDistance[i][j].duration/60) + " Menit";
            }
            td.appendChild(h4)
            tr.appendChild(td)
        }

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayLocation[i].weight + " Kg";
        td.appendChild(h4)
        tr.appendChild(td)

        tbdy.appendChild(tr);
    }

    tbl.appendChild(tbdy);
    body.appendChild(tbl);
}

//digunakan untuk menentukan jarak vrp oleh jarak
function countVRPByDistance(){

    var choosen = [];
    var result = [];

    var final_route = 0;
    var final_time = 0;
    var final_weight = 0;

    var i = 0;
    var weightSum = weightSumOrder;

    while (weightSum > 0) {
        var indexDriver = 0;
        //looping berdasarkan jumlah driver
        while(indexDriver < arrayDriver.length){
            var beratDriver = arrayDriver[indexDriver].weight;
            //digunakan untuk menentukan index pemesanan sekarang
            var index = 0;
            //digunakan untuk menyimpan route
            var route = [];
            var routeAll = [];
            var order = [];

            var total_route = 0;
            var total_time = 0;
            var total_weight = 0;

            var driver;

            routeAll.push(0);

            //mencari index pemesanan sampai kapasitas driver terpenuhi
            while (beratDriver > 0){
                var object = [];
                var dis = 999999999999;
                var dur = 999999999999;
                var steps;
                var searchIndex = 0;

                //proses mencari index udah digunakan atau belum
                for (var j = 0; j < arrayLocation.length; j++) {
                    //mencaari apapkah index udah digunakan atau belum
                    if (index != j && j != 0) {

                        //proses pengecheckan apakah index udah digunakan atau tidak
                        var bol = true;
                        for (var k = 0; k < choosen.length; k++) {
                            if (choosen[k] == arrayLocation[j].id) {
                                bol = false;
                            }
                        }

                        // jika belum digunakan
                        if (bol) {
                            console.log("Index = " + arrayDistance[index][j].distance + " J = " + arrayDistance[index][j].duration);
                            //menghitung rute dari titik index ke titik index yang dicari
                            var cDis = arrayDistance[index][j].distance;
                            var cDur = arrayDistance[index][j].duration;
                            //pengecekan apakah rute tersebut rute terdekat ?
                            if (dis > cDis) {
                                dis = cDis;
                                dur = cDur;
                                searchIndex = j;
                            }
                        }

                    }
                }

                //check apakah berat pesanan tersebut tidak melebihi dari berat driver
                if (beratDriver >= arrayLocation[searchIndex].weight && searchIndex != 0) {

                    object.route = arrayLocation[index].id + " -> " + arrayLocation[searchIndex].id;
                    object.distance = dis;
                    object.duration = dur;
                    object.steps = arrayDistance[index][searchIndex].steps;
                    object.weight = arrayLocation[searchIndex].weight;

                    total_route = total_route + object.distance;
                    total_time = total_time + object.duration;
                    total_weight = total_weight + object.weight;

                    routeAll.push(arrayLocation[searchIndex].id);
                    order.push(arrayLocation[searchIndex]);
                    route.push(object);

                    choosen.push(arrayLocation[searchIndex].id);
                    index = searchIndex;

                    beratDriver = beratDriver - arrayLocation[searchIndex].weight;
                    weightSum = weightSum - arrayLocation[searchIndex].weight;

                    driver = arrayDriver[indexDriver];
                    console.log(indexDriver);
                }else {
                    beratDriver = 0;
                }

            }

            if (index != 0) {
                var object = [];
                object.route = arrayLocation[index].id + " -> 0";
                object.distance = arrayDistance[index][0].distance;
                object.duration = arrayDistance[index][0].duration;
                object.steps = arrayDistance[index][0].steps;
                object.weight = 0;

                // total_route = total_route + arrayDistance[index][0].distance;
                // total_time = total_time + arrayDistance[index][0].duration;

                final_route = final_route + total_route;
                final_weight = final_weight + total_weight;
                final_time = final_time + total_time;

                route.push(object);
                routeAll.push(0);

                console.log(driver);

                result_item = [];
                result_item.id_order = order;
                result_item.route_all = routeAll;
                result_item.total_route = total_route;
                result_item.total_weight = total_weight;
                result_item.total_time = total_time;
                result_item.driver = driver;
                result_item.route_item = route;

                result.push(result_item);
            }

            if (choosen.length > arrayLocation.length - 1) {
                if (indexDriver == arrayDriver.length) {
                    indexDriver = 0;
                }
            }else {
                indexDriver++;
            }
        }

    }

    var final_result = [];
    final_result.distance = final_route;
    final_result.duration = final_time;
    final_result.weight = final_weight;
    final_result.items = result;

    arrayVRPDistance = final_result;
    displayTabelVRP(arrayVRPDistance, 'distance');
    displayMapsVrpAll(arrayVRPDistance, 'distance');
    console.log(final_result);
}

//dipsplay data menentukan delivery
function displayTabelVRPDistance(arrayVRPDistance){

    var title = document.getElementById('titledistance');
    var judul = document.createElement('h3');
    judul.innerHTML = "Tabel Route Pengiriman Menggunakan VRP by Distance";
    title.appendChild(judul);

    var body = document.getElementById('distance');
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    var tbdy = document.createElement('tbody');

    //start
    var th = document.createElement('tr');

    //row 1
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "ID Pengiriman";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 3
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Nama Driver";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 2
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "ID Pemesanan";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 4
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Route";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 5
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Deskrpisi Route";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 6
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Jarak / Waktu";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 7
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Berat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 8
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total Jarak";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 9
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total Berat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    for (var i = 0; i < arrayVRPDistance.items.length; i++) {

        var tr = document.createElement('tr');

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = "Pengiriman-" +(i+1);
        td.appendChild(h4)
        tr.appendChild(td)

        //display driver
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayVRPDistance.items[i].driver.username;
        td.appendChild(h4)
        tr.appendChild(td)

        //display id pemesanan
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '100%';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].id_order.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.width = '100%';
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = "Order-" + arrayVRPDistance.items[i].id_order[j].id;
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display route
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        for (var j = 0; j < arrayVRPDistance.items[i].route_all.length; j++) {
            if (j == arrayVRPDistance.items[i].route_all.length-1) {
                h4.innerText += arrayVRPDistance.items[i].route_all[j];
            }else {
                h4.innerText += arrayVRPDistance.items[i].route_all[j] + " => ";
            }
        }
        td.appendChild(h4)
        tr.appendChild(td)

        //display deskrispi route
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '100%';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].route_item.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = arrayVRPDistance.items[i].route_item[j].route;
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display jarak dan waktu
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '132px';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].route_item.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = Math.round(arrayVRPDistance.items[i].route_item[j].distance/1000) + " Km / " + Math.round(arrayVRPDistance.items[i].route_item[j].duration/60) + " Menit";
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display berat
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '100%';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].route_item.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = arrayVRPDistance.items[i].route_item[j].weight + " Kg";
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display total jarak dan waktu
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.width = "132px";
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = Math.round(arrayVRPDistance.items[i].total_route/1000) + " Km / " + Math.round(arrayVRPDistance.items[i].total_time/60) + " Menit";
        td.appendChild(h4)
        tr.appendChild(td)

        //display total berat
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayVRPDistance.items[i].total_weight + " Kg";
        td.appendChild(h4)
        tr.appendChild(td)

        tbdy.appendChild(tr);

    }

    //start
    var th = document.createElement('tr');

    //row 1
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 3
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 2
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 4
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 5
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 6
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 7
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 8
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = Math.round(arrayVRPDistance.distance/1000) + " Km / " + Math.round(arrayVRPDistance.duration/60) + " Menit";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 9
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = arrayVRPDistance.weight + " Kg";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    tbl.appendChild(tbdy);
    body.appendChild(tbl);
}

//display maps untuk vrp
function displayMapsVrp(arrayVRPDistance){
    var title = document.getElementById('titlemapdistance');
    var judul = document.createElement('h3');
    judul.innerHTML = "Peta Route Pengiriman Menggunakan VRP by Distance";
    title.appendChild(judul);

    var center = new google.maps.LatLng(arrayLocation[0].lat, arrayLocation[0].lng);
    var vrpCanvas = document.getElementById("mapsdistance");
    vrpCanvas.style.height = "320px";
    vrpCanvas.style.width = "100%";
    var vrMaps = new google.maps.Map(vrpCanvas, {
            center: center,
            zoom: 13,
            mapTypeId: 'roadmap',
        }
    );
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    var bounds = new google.maps.LatLngBounds();
    var imageOrder = "http://localhost/jualikan.id/frontend/web/img/order_green_marker.png";
    var imageKoperasi = "http://localhost/jualikan.id/frontend/web/img/icon_company.png";

    //add marker koperasi
    var posisi_koperasi = new google.maps.LatLng(arrayLocation[0].lat, arrayLocation[0].lng);
    var marker = new google.maps.Marker({
        position: posisi_koperasi,
        map: vrMaps,
        icon: imageKoperasi,
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infoWindow.setContent("<div style='float:left; margin-bottom:0px;'>" +
                                  "<img src=http://localhost/jualikan.id/" + arrayLocation[0].image + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px; width:200px;'>"+
                                  "<h4 style='margin-top:0px;'><b>" + arrayLocation[0].name +"</b></h4>"+
                                  "<p style='margin-top:-10px;'>" + arrayLocation[0].address + "</p></div>");
                                  // "<p style='margin-top:-10px;'>Berat Order : " + contentDialog[x][3] + " Kg | Biaya : Rp. " + contentDialog[x][4] + "</p></div>");
            infoWindow.open(vrMaps, marker);
        }
    })(marker, i));

    bounds.extend(marker.position);

    //add marker pesanan
    for (var i = 0; i < arrayVRPDistance.items.length; i++) {
        for (var j = 0; j < arrayVRPDistance.items[i].id_order.length; j++) {
            console.log("I : " + i + " | J " + j);
            console.log(arrayVRPDistance.items[i].id_order[j]);
            var order = arrayVRPDistance.items[i];
            var posisi_order = new google.maps.LatLng(order.id_order[j].lat, order.id_order[j].lng);
            var marker = new google.maps.Marker({
                position: posisi_order,
                map: vrMaps,
                icon: imageOrder,
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    console.log(arrayVRPDistance.items[i].id_order[j]);
                    infoWindow.setContent("<div style='float:left; margin-bottom:0px;'>" +
                                          "<img src=" + order.id_order[i].image + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;width:200px;'>"+
                                          "<h4 style='margin-top:0px;'><b>" + order.id_order[i].name +"</b></h4>"+
                                          "<p style='margin-top:-10px;'>" + order.id_order[i].address + "</p>"+
                                          "<p style='margin-top:-10px;'>Berat Order : " + order.id_order[i].weight + " Kg | Biaya : Rp. " + order.id_order[i].price + "</p></div>");
                    infoWindow.open(vrMaps, marker);
                }
            })(marker, i));
            bounds.extend(marker.position);
        }
        for (var k = 0; k < arrayVRPDistance.items[i].route_item.length; k++) {
            var renderDirections = new google.maps.DirectionsRenderer({
                directions: arrayVRPDistance.items[i].route_item[k].steps,
                map: vrMaps,
                polylineOptions: {
                  strokeColor: colors[i]
                },
                suppressMarkers: true
            });
        }
    }
    vrMaps.fitBounds(bounds);
}

//dipsplay data menentukan delivery
function displayTabelVRP(arrayVRPDistance, kode){
    var post = "[";

    var title = document.getElementById('title'+kode);
    var judul = document.createElement('h3');
    judul.innerHTML = "Tabel Route Pengiriman Menggunakan VRP by " + kode;
    title.appendChild(judul);



    console.log("String : " + arrayVRPDistance.join(", "));

    var body = document.getElementById(kode);
    var tbl = document.createElement('table');
    tbl.style.width = '100%';
    tbl.setAttribute('border', '1');
    var tbdy = document.createElement('tbody');

    //start
    var th = document.createElement('tr');

    //row 1
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "ID Pengiriman";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 3
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Nama Driver";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 2
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "ID Pemesanan";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 4
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Route";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 5
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Deskrpisi Route";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 6
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Jarak / Waktu";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 7
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Berat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 8
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total Jarak";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 9
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total Berat";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    for (var i = 0; i < arrayVRPDistance.items.length; i++) {

        post = post + '{"order":[';

        var tr = document.createElement('tr');

        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = "Pengiriman-" +(i+1);
        td.appendChild(h4)
        tr.appendChild(td)

        //display driver
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayVRPDistance.items[i].driver.username;
        td.appendChild(h4)
        tr.appendChild(td)

        //display id pemesanan
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '100%';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].id_order.length; j++) {

            if (j == arrayVRPDistance.items[i].id_order.length - 1) {
                post = post + arrayVRPDistance.items[i].id_order[j].id;
            }else {
                post = post + arrayVRPDistance.items[i].id_order[j].id + ',';
            }

            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.width = '100%';
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = "Order-" + arrayVRPDistance.items[i].id_order[j].id;
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }


        if (i == arrayVRPDistance.items.length - 1) {
            post = post + '],"driver":' + arrayVRPDistance.items[i].driver.id + ',"koperasi":' + koperasi.koperasi_id + ',"waktu":' + arrayVRPDistance.items[i].total_time + ',"jarak":' + arrayVRPDistance.items[i].total_route + '}';
        }else {
            post = post + '],"driver":' + arrayVRPDistance.items[i].driver.id + ',"koperasi":' + koperasi.koperasi_id + ',"waktu":' + arrayVRPDistance.items[i].total_time + ',"jarak":' + arrayVRPDistance.items[i].total_route + '},';
        }

        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display route
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        for (var j = 0; j < arrayVRPDistance.items[i].route_all.length; j++) {
            if (j == arrayVRPDistance.items[i].route_all.length-1) {
                h4.innerText += arrayVRPDistance.items[i].route_all[j];
            }else {
                h4.innerText += arrayVRPDistance.items[i].route_all[j] + " => ";
            }
        }
        td.appendChild(h4)
        tr.appendChild(td)

        //display deskrispi route
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '100%';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].route_item.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = arrayVRPDistance.items[i].route_item[j].route;
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display jarak dan waktu
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '132px';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].route_item.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = Math.round(arrayVRPDistance.items[i].route_item[j].distance/1000) + " Km / " + Math.round(arrayVRPDistance.items[i].route_item[j].duration/60) + " Menit";
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display berat
        var td = document.createElement('td');
        var newtable = document.createElement('table');
        newtable.style.width = '100%';
        newtable.setAttribute('border', '1');
        var newtbdy = document.createElement('tbody');
        for (var j = 0; j < arrayVRPDistance.items[i].route_item.length; j++) {
            //row1
            var newtr = document.createElement('tr');
            var newtd = document.createElement('td');
            var h4 = document.createElement('h4');
            newtd.style.paddingLeft = "14px";
            newtd.style.paddingRight = "14px";
            h4.innerText = arrayVRPDistance.items[i].route_item[j].weight + " Kg";
            newtd.appendChild(h4)
            newtr.appendChild(newtd);
            newtbdy.appendChild(newtr);
        }
        newtable.appendChild(newtbdy);
        td.appendChild(newtable)
        tr.appendChild(td)

        //display total jarak dan waktu
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.width = "132px";
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = Math.round(arrayVRPDistance.items[i].total_route/1000) + " Km / " + Math.round(arrayVRPDistance.items[i].total_time/60) + " Menit";
        td.appendChild(h4)
        tr.appendChild(td)

        //display total berat
        var td = document.createElement('td');
        var h4 = document.createElement('h4');
        td.style.paddingLeft = "14px";
        td.style.paddingRight = "14px";
        h4.innerText = arrayVRPDistance.items[i].total_weight + " Kg";
        td.appendChild(h4)
        tr.appendChild(td)

        tbdy.appendChild(tr);



    }

    post = post + ']';

    console.log("Post : " + post);

    //start
    var th = document.createElement('tr');

    //row 1
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 3
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 2
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 4
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 5
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 6
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 7
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = "Total";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 8
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = Math.round(arrayVRPDistance.distance/1000) + " Km / " + Math.round(arrayVRPDistance.duration/60) + " Menit";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    //row 9
    var td = document.createElement('th');
    var h4 = document.createElement('h4');
    td.style.paddingLeft = "14px";
    td.style.paddingRight = "14px";
    h4.innerText = arrayVRPDistance.weight + " Kg";
    h4.style.fontWeight = "bold"
    td.appendChild(h4)
    th.appendChild(td)

    tbdy.appendChild(th);

    tbl.appendChild(tbdy);
    body.appendChild(tbl);

    var back = document.getElementById('button'+kode);
    var a = document.createElement('a');
    var button = document.createElement('button');
    button.className = "btn btn-success";
    button.style.marginTop = "20px";
    button.innerHTML = "Kirim menggunakana metode " + kode;
    a.appendChild(button);
    a.href = server + "jualikan.id/backend/web/api/v1/driver/postPengiriman.php?id=" + post;
    back.appendChild(a);
}

//display maps untuk vrp
function displayMapsVrpAll(arrayVRPDistance, kode){
    var title = document.getElementById('titlemap' + kode);
    var judul = document.createElement('h3');
    judul.innerHTML = "Peta Route Pengiriman Menggunakan VRP by " + kode;
    title.appendChild(judul);

    var center = new google.maps.LatLng(arrayLocation[0].lat, arrayLocation[0].lng);
    var vrpCanvas = document.getElementById("maps"+kode);
    vrpCanvas.style.height = "320px";
    vrpCanvas.style.width = "100%";
    var vrMaps = new google.maps.Map(vrpCanvas, {
            center: center,
            zoom: 13,
            mapTypeId: 'roadmap',
        }
    );
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    var bounds = new google.maps.LatLngBounds();
    var imageOrder = "http://localhost/jualikan.id/frontend/web/img/order_green_marker.png";
    var imageKoperasi = "http://localhost/jualikan.id/frontend/web/img/icon_company.png";

    //add marker koperasi
    var posisi_koperasi = new google.maps.LatLng(arrayLocation[0].lat, arrayLocation[0].lng);
    var marker = new google.maps.Marker({
        position: posisi_koperasi,
        map: vrMaps,
        icon: imageKoperasi,
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infoWindow.setContent("<div style='float:left; margin-bottom:0px;'>" +
                                  "<img src=http://localhost/jualikan.id/" + arrayLocation[0].image + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px; width:200px;'>"+
                                  "<h4 style='margin-top:0px;'><b>" + arrayLocation[0].name +"</b></h4>"+
                                  "<p style='margin-top:-10px;'>" + arrayLocation[0].address + "</p></div>");
                                  // "<p style='margin-top:-10px;'>Berat Order : " + contentDialog[x][3] + " Kg | Biaya : Rp. " + contentDialog[x][4] + "</p></div>");
            infoWindow.open(vrMaps, marker);
        }
    })(marker, i));

    bounds.extend(marker.position);

    //add marker pesanan
    for (var i = 0; i < arrayVRPDistance.items.length; i++) {
        for (var j = 0; j < arrayVRPDistance.items[i].id_order.length; j++) {
            console.log("I : " + i + " | J " + j);
            console.log(arrayVRPDistance.items[i].id_order[j]);
            var order = arrayVRPDistance.items[i];
            var posisi_order = new google.maps.LatLng(order.id_order[j].lat, order.id_order[j].lng);
            var marker = new google.maps.Marker({
                position: posisi_order,
                map: vrMaps,
                icon: imageOrder,
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    console.log(arrayVRPDistance.items[i].id_order[j]);
                    infoWindow.setContent("<div style='float:left; margin-bottom:0px;'>" +
                                          "<img src=" + order.id_order[i].image + " style='width:52px; height:52px'/></div><div style='float:right; margin-left:8px; margin-bottom:0px;width:200px;'>"+
                                          "<h4 style='margin-top:0px;'><b>" + order.id_order[i].name +"</b></h4>"+
                                          "<p style='margin-top:-10px;'>" + order.id_order[i].address + "</p>"+
                                          "<p style='margin-top:-10px;'>Berat Order : " + order.id_order[i].weight + " Kg | Biaya : Rp. " + order.id_order[i].price + "</p></div>");
                    infoWindow.open(vrMaps, marker);
                }
            })(marker, i));
            bounds.extend(marker.position);
        }
        for (var k = 0; k < arrayVRPDistance.items[i].route_item.length; k++) {
            var renderDirections = new google.maps.DirectionsRenderer({
                directions: arrayVRPDistance.items[i].route_item[k].steps,
                map: vrMaps,
                polylineOptions: {
                  strokeColor: colors[i]
                },
                suppressMarkers: true
            });
        }
    }
    vrMaps.fitBounds(bounds);
}

//digunakan untuk menentukan jarak vrp oleh berat
function countVRPWeight(){
    var choosen = [];
    var result = [];

    var final_route = 0;
    var final_time = 0;
    var final_weight = 0;

    var i = 0;
    var weightSum = weightSumOrder;

    while (weightSum > 0) {
        var indexDriver = 0;
        //looping berdasarkan jumlah driver
        while(indexDriver < arrayDriver.length){
            var beratDriver = arrayDriver[indexDriver].weight;
            //digunakan untuk menentukan index pemesanan sekarang
            var index = 0;
            //digunakan untuk menyimpan route
            var route = [];
            var routeAll = [];
            var order = [];

            var total_route = 0;
            var total_time = 0;
            var total_weight = 0;

            var driver;

            routeAll.push(0);

            //mencari index pemesanan sampai kapasitas driver terpenuhi
            while (beratDriver > 0){
                var object = [];
                var dis = 999999999999;
                var dur = 999999999999;
                var steps;
                var searchIndex = 0;

                //proses mencari index udah digunakan atau belum
                for (var j = 0; j < arrayLocation.length; j++) {
                    //mencaari apapkah index udah digunakan atau belum
                    if (index != j && j != 0) {

                        //proses pengecheckan apakah index udah digunakan atau tidak
                        var bol = true;
                        for (var k = 0; k < choosen.length; k++) {
                            if (choosen[k] == arrayLocation[j].id) {
                                bol = false;
                            }
                        }

                        // jika belum digunakan
                        if (bol) {
                            console.log("Index = " + arrayLocation[j].id+ " Berat = " + arrayLocation[j].weight);
                            //menghitung rute dari titik index ke titik index yang dicari
                            var cDis = arrayDistance[index][j].distance;
                            var cDur = arrayDistance[index][j].duration;
                            //pengecekan apakah rute tersebut rute terdekat ?
                            if (beratDriver >= arrayLocation[j].weight) {
                                dis = cDis;
                                dur = cDur;
                                searchIndex = j;
                                break;
                            }
                        }

                    }
                }

                //check apakah berat pesanan tersebut tidak melebihi dari berat driver
                if (beratDriver >= arrayLocation[searchIndex].weight && searchIndex != 0) {

                    object.route = arrayLocation[index].id + " -> " + arrayLocation[searchIndex].id;
                    object.distance = dis;
                    object.duration = dur;
                    object.steps = arrayDistance[index][searchIndex].steps;
                    object.weight = arrayLocation[searchIndex].weight;

                    total_route = total_route + object.distance;
                    total_time = total_time + object.duration;
                    total_weight = total_weight + object.weight;

                    routeAll.push(arrayLocation[searchIndex].id);
                    order.push(arrayLocation[searchIndex]);
                    route.push(object);

                    choosen.push(arrayLocation[searchIndex].id);
                    index = searchIndex;

                    beratDriver = beratDriver - arrayLocation[searchIndex].weight;
                    weightSum = weightSum - arrayLocation[searchIndex].weight;

                    driver = arrayDriver[indexDriver];
                    console.log(indexDriver);
                }else {
                    beratDriver = 0;
                }

            }

            if (index != 0) {
                var object = [];
                object.route = arrayLocation[index].id + " -> 0";
                object.distance = arrayDistance[index][0].distance;
                object.duration = arrayDistance[index][0].duration;
                object.steps = arrayDistance[index][0].steps;
                object.weight = 0;

                // total_route = total_route + arrayDistance[index][0].distance;
                // total_time = total_time + arrayDistance[index][0].duration;

                final_route = final_route + total_route;
                final_weight = final_weight + total_weight;
                final_time = final_time + total_time;

                route.push(object);
                routeAll.push(0);

                console.log(driver);

                result_item = [];
                result_item.id_order = order;
                result_item.route_all = routeAll;
                result_item.total_route = total_route;
                result_item.total_weight = total_weight;
                result_item.total_time = total_time;
                result_item.driver = driver;
                result_item.route_item = route;

                result.push(result_item);
            }

            if (choosen.length > arrayLocation.length - 1) {
                if (indexDriver == arrayDriver.length) {
                    indexDriver = 0;
                }
            }else {
                indexDriver++;
            }
        }

    }

    var final_result = [];
    final_result.distance = final_route;
    final_result.duration = final_time;
    final_result.weight = final_weight;
    final_result.items = result;

    arrayVRPWeight = final_result;
    displayTabelVRP(arrayVRPWeight, 'weight');
    displayMapsVrpAll(arrayVRPWeight, 'weight');
    console.log(final_result);
}

function getDistance(x, y){

    var origin = new google.maps.LatLng(arrayLocation[x].lat, arrayLocation[x].lng);
    var destination = new google.maps.LatLng(arrayLocation[y].lat, arrayLocation[y].lng);
    var directionsService = new google.maps.DirectionsService();

    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        provideRouteAlternatives: true
    }, function (response, status){
        if (status == google.maps.DirectionsStatus.OK) {
            var legs = response.routes[0].legs[0].distance.value;
            var time = response.routes[0].legs[0].duration.value;
            var steps = response;
            // console.log("X = " + x + " | Y = " + y + " | Distance = " + legs + " | Time = " + time);
            // console.log(steps);
            if (y == 0) {
                temp = [];
                var obj = [];
                obj.distance = legs;
                obj.duration = time;
                obj.steps = steps;
                temp.push(obj);
            }else if (y == arrayLocation.length - 1) {
                var obj = [];
                obj.distance = legs;
                obj.duration = time;
                obj.steps = steps;
                temp.push(obj);
                arrayDistance.push(temp);
                console.log(arrayDistance[x].length);
            }else {
                var obj = [];
                obj.distance = legs;
                obj.duration = time;
                obj.steps = steps;
                temp.push(obj);
            }

        }else {
            // console.log(status + " pulang");
            // window.alert('Directions request failed due to ' + status);
        }
    });
}
