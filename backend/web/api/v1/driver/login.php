<?php
    include '../../connect.php';

    $response = array();

    if (isset($_POST['phone']) &&
        isset($_POST['password']) &&
        isset($_POST['device_id'])) {

        //do something when right
        $user_phone = $_POST['phone'];
        $user_password = $_POST['password'];
        $user_device_id = $_POST['device_id'];

        $query = "SELECT * FROM user_driver WHERE driver_phone = '$user_phone' AND driver_password = '$user_password'";
        $result = $connect->query($query);

        if ($result->num_rows > 0) {
            $object = array();
            while ($row = $result->fetch_assoc()){
                $object = $row;
            }

            $id = $object['driver_id'];
            $sql = "UPDATE user_driver SET driver_device_id = '$user_device_id' WHERE driver_id = '$id'";
            $connect->query($sql);

            $response['response'] = 200;
            $response['status'] = true;
            $response['data'] = $object;
        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "Telp dan Password Salah";
        }

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

?>
