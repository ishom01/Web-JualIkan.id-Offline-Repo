<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['full_name']) &&
        isset($_POST['phone']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['kota_id']) &&
        isset($_POST['alamat'])) {

        //do something when right
        $user_full_name = $_POST['full_name'];
        $user_image = "frontend/web/img/user_default.png";
        $user_phone = $_POST['phone'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $user_device_id = "";
        $user_kota_id = $_POST['kota_id'];
        $user_address = $_POST['alamat'];
        $user_saldo = 0;

        $query = "INSERT INTO user_pengguna (
          user_full_name,
          user_image,
          user_phone,
          user_email,
          user_password,
          user_device_id,
          user_kota_id,
          user_address,
          user_saldo) VALUES (
            '$user_full_name',
            '$user_image',
            '$user_phone',
            '$user_email',
            '$user_password',
            '$user_device_id',
            '$user_kota_id',
            '$user_address',
            '$user_saldo')";

        if ($connect->query($query)) {
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Register Berhasil";
        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "Register Gagal";
        }

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

?>
