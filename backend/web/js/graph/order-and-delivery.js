var tanggal = [];
var tanggal1 = [];

var order_sukses = [];
var order_gagal = [];
var pengirman = [];

var order_sukses_value = [];
var order_gagal_value = [];
var pengirman_value = [];

var pengiriman_sukses = [];
var pengiriman_gagal = [];
var pengiriman_dalam_proses = [];

var pengiriman_sukses_text, pengiriman_gagal_text, pengiriman_dalam_proses_text;

function displayDelivery(id){
    $.ajax({
        type : "GET",
        data : "",
        url : "http://localhost/jualikan.id/backend/web/api/graph/order-delivery.php?id=" + id,
        success : function(result){

            var resultObj = JSON.parse(result);
            $.each(resultObj, function(id, val){

                console.log(val.order_berhasil);
                tanggal.push(val.date);
                order_sukses.push(val.order_berhasil);
                order_gagal.push(val.order_gagal);
                pengirman.push(val.delivery);

            });

            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Jumlah pesanan yang sukses',
                    data: order_sukses,
                    fill: false,
                    borderColor: [
                        'rgba(0, 255, 0, 1)'
                    ],
                    backgroundColor: [
                        'rgba(0, 255, 0, 0.5)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Jumlah pesanan yang gagal',
                    data: order_gagal,
                    fill: false,
                    borderColor: [
                        'rgba(255, 0, 0, 1)'
                    ],
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.5)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Jumlah pesanan dalam proses',
                    data: pengirman,
                    fill: false,
                    borderColor: [
                        'rgba(0, 0, 255, 1)'
                    ],
                    backgroundColor: [
                        'rgba(0, 0, 255, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    });

    $.ajax({
        type : "GET",
        data : "",
        url : "http://localhost/jualikan.id/backend/web/api/graph/order-delivery-price.php?id=" + id,
        success : function(result){
            var resultObj = JSON.parse(result);

            $.each(resultObj, function(id, val){

              console.log(val.order_berhasil);

              pengiriman_sukses.push(val.delivery_sukses);
              pengiriman_gagal.push(val.delivery_gagal);
              pengiriman_dalam_proses.push(val.delivery_dalam_proses);

              tanggal1.push(val.date);
              pengiriman_sukses_text = val.delivery_sukses_text;
              pengiriman_gagal_text = val.delivery_gagal_text;
              pengiriman_dalam_proses_text = val.delivery_dalam_proses_text;

            });

            var ctx1 = document.getElementById("myChart1").getContext('2d');
            var myChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: tanggal1,
                datasets: [{
                    label: pengiriman_sukses_text,
                    data: pengiriman_sukses,
                    fill: false,
                    borderColor: [
                        'rgba(0, 255, 0, 1)'
                    ],
                    backgroundColor: [
                        'rgba(0, 255, 0, 0.5)'
                    ],
                    borderWidth: 1
                }, {
                    label: pengiriman_dalam_proses_text,
                    data: pengiriman_dalam_proses,
                    fill: false,
                    borderColor: [
                        'rgba(0, 0, 255, 1)'
                    ],
                    backgroundColor: [
                        'rgba(0, 0, 255, 0.5)'
                    ],
                    borderWidth: 1
                },{
                    label: pengiriman_gagal_text,
                    data: pengiriman_gagal,
                    fill: false,
                    borderColor: [
                        'rgba(255, 0, 0, 1)'
                    ],
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.5)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    });
}
