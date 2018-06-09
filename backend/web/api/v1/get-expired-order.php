<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['id_user'])) {

        $order_list = array();

        $id_user = $_POST['id_user'];
        $sql = "SELECT * FROM `order` WHERE (order_status = '5' or order_status = '3') and (`order_user_id` = '$id_user')";
        $result = $connect->query($sql);

        while ($row = $result->fetch_assoc()){
            $object = array();
            $object['orderId'] = "JD-".$row['order_id'];
            $object['orderIdNumber'] = $row['order_id'];
            $object['orderAdress'] = $row['order_location_adress'];
            $object['orderTotal'] = (int)$row['order_payment_total'];
            $object['orderDate'] = $row['order_date'];
            $object['orderStatus'] = (int)$row['order_status'];
            $order_list[] = $object;
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Sukses Ambil Data";
        $response['data'] = $order_list;

    }else {
        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
