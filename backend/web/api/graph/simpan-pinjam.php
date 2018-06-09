<?php
    include '../connect.php';

    $id = $_GET['id'];

    $month = Date('m');
    $last  = date('t');
    $response = array();

    for ($i = 1; $i <= $last; $i++){

        $tanggal = "0";

        if ($i < 10) {
            $tanggal = "0" . $i;
        } else {
            $tanggal = $i;
        }

        $date = Date('Y-'. $month. '-'.$tanggal);

        $obj = array();
        $obj["id"] = $i;
        $obj["date"] = $date;

        //simpanan

        $sql1 = "SELECT * FROM `koperasi_pinjaman` WHERE pinjaman_koperasi_id = '$id' and pinjaman_date like '%{$date}%'";
        $res1 = $connect->query($sql1);

        $tot1 = 0;

        while($row1 = $res1->fetch_assoc()){
            $tot1 = (int) $row1['pinjaman_jumlah'] + $tot1;
        }

        $obj["order_text"] = "Koperasi Pinjaman";
        $obj["order"] = $tot1;


        $sql2 = "SELECT * FROM koperasi_simpanan WHERE simpanan_koperasi_id = '$id' and simpanan_date like '$date'";
        $res2 = $connect->query($sql2);
        $row2 = $res2->num_rows;

        $tot2 = 0;

        while($row2 = $res2->fetch_assoc()){
            $tot2 = (int) $row2['simpanan_jumlah'] + $tot2;
        }

        $obj["delivery_text"] = "Koperasi Simpanan";
        $obj["delivery"] = $tot2;

        $response[] = $obj;
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
