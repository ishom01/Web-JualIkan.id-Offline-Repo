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

        $sql1 = "SELECT * FROM `delivery` WHERE (delivery_order_koperasi_id = '$id' and delivery_time_depart like '%{$date}%') and (delivery_status = 0 or delivery_status = 1)";
        $res1 = $connect->query($sql1);

        $tot1 = 0;

        while($row1 = $res1->fetch_assoc()){
            $tot1++;
        }

        $obj["delivery_dalam_proses_text"] = "Jumlah pengiriman dalam proses";
        $obj["delivery_dalam_proses"] = $tot1;

        $sql2 = "SELECT * FROM `delivery` WHERE (delivery_order_koperasi_id = '$id' and delivery_time_depart like '%{$date}%') and delivery_status = 2";
        $res2 = $connect->query($sql2);
        $row2 = $res2->num_rows;

        $tot2 = 0;

        while($row2 = $res2->fetch_assoc()){
            $tot2++;
        }

        $obj["delivery_sukses_text"] = "Jumlah pengiriman yang sukses";
        $obj["delivery_sukses"] = $tot2;

        $sql3 = "SELECT * FROM `delivery` WHERE (delivery_order_koperasi_id = '$id' and delivery_time_depart like '%{$date}%') and delivery_status = 2";
        $res3 = $connect->query($sql3);
        $row3 = $res3->num_rows;

        $tot3 = 0;

        while($row3 = $res3->fetch_assoc()){
            $tot3++;
        }

        $obj["delivery_gagal_text"] = "Jumlah pengiriman yang gagal";
        $obj["delivery_gagal"] = $tot2;

        $response[] = $obj;
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
