<?php
    include '../connect.php';

    $response = array();
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");

    if (isset($_POST['postIdKeranjang']) &&
        isset($_POST['postIdUser']) &&
        isset($_POST['postAlamat']) &&
        isset($_POST['postLatAlamat']) &&
        isset($_POST['postLngAlamat']) &&
        isset($_POST['postPaymentType']) &&
        isset($_POST['postIdKoperasi']) &&
        isset($_POST['postWaktuPengiriman']) &&
        isset($_POST['postJarakPengiriman']) &&
        isset($_POST['postPaymentUrl']) &&
        isset($_POST['postBiayaPengiriman']) &&
        isset($_POST['postBeratOrder']) &&
        isset($_POST['postTotalPembayaran']) &&
        isset($_POST['postIdWaktuPengiriman']) &&
          isset($_POST['postOrderStatus'])) {

        //do something when right
        $postIdKeranjang = $_POST['postIdKeranjang'];
        $postIdUser = $_POST['postIdUser'];
        $postAlamat = $_POST['postAlamat'];
        $postLatAlamat = $_POST['postLatAlamat'];
        $postLngAlamat = $_POST['postLngAlamat'];
        $postPaymentType = $_POST['postPaymentType'];
        $postIdKoperasi = $_POST['postIdKoperasi'];
        $postWaktuPengiriman = $_POST['postWaktuPengiriman'];
        $postJarakPengiriman = $_POST['postJarakPengiriman'];
        $postPaymentUrl = $_POST['postPaymentUrl'];
        $postBiayaPengiriman = $_POST['postBiayaPengiriman'];
        $postBeratOrder = $_POST['postBeratOrder'];
        $postTotalPembayaran = $_POST['postTotalPembayaran'];
        $postIdWaktuPengiriman = $_POST['postIdWaktuPengiriman'];
        $postOrderStatus = $_POST['postOrderStatus'];

        $query = "INSERT INTO `order` (
          `order_id`,
          `order_cart_id`,
          `order_user_id`,
          `order_location_adress`,
          `order_location_lat`,
          `order_location_lng`,
          `order_driver_id`,
          `order_drive_track_id`,
          `order_koperasi_location_id`,
          `order_delivery_time`,
          `order_delivery_distance`,
          `order_delivery_payment`,
          `order_delivery_payment_url`,
          `order_weight`,
          `order_date`,
          `order_payment_type_id`,
          `order_payment_total`,
          `order_delivery_time_id`,
          `order_status`) VALUES (
            '',
            '$postIdKeranjang',
            '$postIdUser',
            '$postAlamat',
            '$postLatAlamat',
            '$postLngAlamat',
            '0',
            '0',
            '$postIdKoperasi',
            '$postWaktuPengiriman',
            '$postJarakPengiriman',
            '$postBiayaPengiriman',
            '$postPaymentUrl',
            '$postBeratOrder',
            '$date',
            '$postPaymentType',
            '$postTotalPembayaran',
            '$postIdWaktuPengiriman',
            '$postOrderStatus')";

        if ($connect->query($query)) {

            $idKeranjang = json_decode($postIdKeranjang);
            for ($i=0; $i < count($idKeranjang) ; $i++) {
                $cart_id = $idKeranjang[$i];
                $sql = "UPDATE `cart` SET `cart_status` = 1 WHERE `cart_id` = '$cart_id' and `cart_user_id` = '$postIdUser'";
                $connect->query($sql);
            }

            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Pemesanan Berhasil";
        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "Pemesanan Gagal";
        }

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

?>
