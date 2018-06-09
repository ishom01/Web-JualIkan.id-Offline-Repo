var tanggal2 = [];

var pinjaman = [];
var simpanan = [];

function displaySimpanPinjam(id){
    $.ajax({
        type : "GET",
        data : "",
        url : "http://localhost/jualikan.id/backend/web/api/graph/simpan-pinjam.php?id=" + id,
        success : function(result){

            var resultObj = JSON.parse(result);
            $.each(resultObj, function(id, val){

                console.log(val.order_berhasil);
                tanggal2.push(val.date);
                pinjaman.push(val.order);
                simpanan.push(val.delivery);

            });

            var ctx2 = document.getElementById("simpanPinjamChart").getContext('2d');
            var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: tanggal2,
                datasets: [
                  {
                     label: 'Jumalah Simpanan Koperasi',
                     data: simpanan,
                     fill: false,
                     borderColor: [
                         'rgba(0, 255, 0, 1)',
                         'rgba(0, 255, 0, 1)',
                         'rgba(0, 255, 0, 1)',
                         'rgba(0, 255, 0, 1)'
                     ],
                     borderWidth: 1
                 },
                 {
                    label: 'Jumalah Pinjaman Koperasi',
                    data: pinjaman,
                    fill: false,
                    borderColor: [
                      'rgba(255, 0, 0, 1)',
                      'rgba(255, 0, 0, 1)',
                      'rgba(255, 0, 0, 1)',
                      'rgba(255, 0, 0, 1)'
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
