<?php
    include '../connect.php';

    $response = array();
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");
    $time = date("H:i:s");

    $statusTime = false;
    $messageTime = "Waktu buka order (05:00 - 17:00)";

    if (isset($_POST['id_user'])) {

        $keranjang_items = array();
        $keranjang = array();
        $delivery_time = array();
        $payment_type = array();

        $id_user = $_POST['id_user'];
        $sql = "SELECT keranjang.*, ikan.* FROM cart as keranjang, fish as ikan WHERE keranjang.cart_user_id = '$id_user' and ikan.fish_id = keranjang.cart_fish_id and keranjang.cart_status = 0";
        $result = $connect->query($sql);
        $total = 0;
        $koperasi_id = 0;

        while ($row = $result->fetch_assoc()){
            $object = array();
            $object['id'] = $row['cart_id'];
            $object['fish_id'] = $row['cart_fish_id'];
            $object['image'] = $row['fish_image'];
            $object['name'] = $row['fish_name'];
            $object['price'] = (int)$row['fish_price'];
            $object['qty'] = (int)$row['cart_fish_qty'];
            $object['total_price'] = $object['price'] * $object['qty'];
            $total = $object['total_price'] + $total;
            $koperasi_id = $row['fish_koperasi_id'];
            $keranjang_items[] = $object;
        }

        $sql = "SELECT * FROM delivery_time";
        $result = $connect->query($sql);

        while ($row = $result->fetch_assoc()){
            $objTime = array();
            $objTime = $row;

            $newDate = date($row['delivery_time_start']);
            $delivTime = strtotime ( '-1 hour' , strtotime ( $newDate ) ) ;
            $delivTime = date ( 'H:i:s' , $delivTime );

            if ($time < $delivTime) {
                $objTime['status'] = 1;
                $statusTime = true;
            }else {
                $objTime['status'] = 0;
            }

            $objTime['message'] = "Batas waktu pemesanan : " . $delivTime;
            $delivery_time[] = $objTime;
        }

        $sql = "SELECT * FROM payment_type";
        $result = $connect->query($sql);

        while ($row = $result->fetch_assoc()){
            $payment_type[] = $row;
        }

        $sql = "SELECT * FROM user_koperasi WHERE koperasi_id = '$koperasi_id'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();

        $koperasi['id'] = $row['koperasi_id'];
        $koperasi['nama'] = $row['koperasi_name'];
        $koperasi['lat'] = $row['koperasi_lat'];
        $koperasi['lng'] = $row['koperasi_lng'];

        $keranjang['items'] = $keranjang_items;
        $keranjang['total'] = $total;
        $keranjang['koperasi'] = $koperasi;

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil menggubah data keranjang";
        $response['statusOrder'] = $statusTime;
        $response['statusMessage'] = $messageTime;
        $response['cart'] = $keranjang;
        $response['delivery_time'] = $delivery_time;
        $response['payment_type'] = $payment_type;
        $response['delviery_cost_pkm'] = 600;

    }else {
        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
