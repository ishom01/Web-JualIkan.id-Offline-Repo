<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['order_id'])) {

        $order_id = $_POST['order_id'];
        $sql = "SELECT * FROM `order` WHERE `order_id` = '$order_id'";
        $result = $connect->query($sql);

        $orderObj = array();
        $keranjangInfo = array();
        $listKeranjang = array();
        $locationInformation = array();
        $paymentInformation = array();

        $totalKeranjang = 0;

        $row = $result->fetch_assoc();

        $arrayKeranjang = json_decode($row['order_cart_id']);

        for ($i=0; $i < count($arrayKeranjang) ; $i++) {

            $idkeranjang = $arrayKeranjang[$i];
            $keranjangObj = array();

            $sql = "SELECT keranjang.*, ikan.* FROM cart as keranjang, fish as ikan WHERE keranjang.cart_id = '$idkeranjang' and ikan.fish_id = keranjang.cart_fish_id";
            $result = $connect->query($sql);
            $row1 = $result->fetch_assoc();

            $keranjangObj['id'] = $row1['cart_id'];
            $keranjangObj['fish_id'] = $row1['cart_fish_id'];
            $keranjangObj['image'] = $row1['fish_image'];
            $keranjangObj['name'] = $row1['fish_name'];
            $keranjangObj['price'] = (int)$row1['fish_price'];
            $keranjangObj['qty'] = (int)$row1['cart_fish_qty'];
            $keranjangObj['total_price'] = $keranjangObj['price'] * $keranjangObj['qty'];
            $totalKeranjang = $keranjangObj['total_price'] + $totalKeranjang;

            $listKeranjang[] = $keranjangObj;

        }

        $keranjangInfo['items'] = $listKeranjang;
        $keranjangInfo['total'] = $totalKeranjang;

        $locationInformation['address'] = $row['order_location_adress'];
        $locationInformation['lat'] = $row['order_location_lat'];
        $locationInformation['lng'] = $row['order_location_lng'];

        $paymentInformation['cart'] = $totalKeranjang;
        $paymentInformation['delivery'] = (int)$row['order_delivery_payment'];
        $paymentInformation['total'] = (int)$row['order_payment_total'];
        $paymentInformation['url'] = $row['order_delivery_payment_url'];

        $orderObj['cart'] = $keranjangInfo;
        $orderObj['orderLocation'] = $locationInformation;
        $orderObj['payment'] = $paymentInformation;
        $orderObj['status'] = (int)$row['order_status'];

        if ($orderObj['status'] == 0) {
            $orderObj['status_txt'] = "Belum Lunas";
        }else if ($orderObj['status'] == 1) {
            $orderObj['status_txt'] = "Dalam Proses";
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil mengambil data dari server";
        $response['data'] = $orderObj;

    }else {
        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
