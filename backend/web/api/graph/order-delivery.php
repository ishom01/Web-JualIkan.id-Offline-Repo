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

        $sql1 = "SELECT * FROM `order` WHERE (order_koperasi_location_id = '$id' and order_date LIKE '%{$date}%') and (order_status = 3)";
        $res1 = $connect->query($sql1);
        $row1 = $res1->num_rows;


        $obj["order_text_berhasil"] = "Order Berhasil";
        $obj["order_berhasil"] = $row1;

        $sql3 = "SELECT * FROM `order` WHERE order_koperasi_location_id = '$id' and order_date like '$date' and order_status = 5";
        $res3 = $connect->query($sql3);
        $row3 = $res3->num_rows;

        $obj["order_text_gagal"] = "Order Gagal";
        $obj["order_gagal"] = $row3;

        $sql2 = "SELECT * FROM `order` WHERE (order_koperasi_location_id = '$id' and order_date LIKE '%{$date}%') and (order_status = 0 or order_status = 1 or order_status = 2)";
        $res2 = $connect->query($sql2);
        $row2 = $res2->num_rows;

        $obj["delivery_text"] = "Delivery";
        $obj["delivery"] = $row2;

        $response[] = $obj;
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
