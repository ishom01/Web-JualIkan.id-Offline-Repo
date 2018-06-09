<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['phone']) &&
        isset($_POST['password']) &&
        isset($_POST['device_id'])) {

        //do something when right
        $user_phone = $_POST['phone'];
        $user_password = $_POST['password'];
        $user_device_id = $_POST['device_id'];

        $query = "SELECT * FROM user_pengguna WHERE user_phone = '$user_phone' AND user_password = '$user_password'";
        $result = $connect->query($query);

        if ($result->num_rows > 0) {
            $object = array();
            while ($row = $result->fetch_assoc()){
                $object = $row;
            }

            $id = $object['user_id'];
            $sql = "UPDATE user_pengguna SET user_device_id = '$user_device_id' WHERE user_id = '$id'";
            $connect->query($sql);

            $response['response'] = 200;
            $response['status'] = true;
            $response['data'] = $object;
        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "Login Gagal";
        }

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

?>
