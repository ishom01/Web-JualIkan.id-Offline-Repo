<?php
include '../../connect.php';

$resposne = array();

if (isset($_POST['driver_id']) && isset($_POST['status'])) {
    $idDriver = $_POST['driver_id'];
    $status = $_POST['status'];

    $sql = "UPDATE user_driver SET driver_status = '$status' WHERE driver_id = '$idDriver'";
    $result = $connect->query($sql);

    $response['response'] = 200;
    $response['status'] = true;

    if ($status == "1") {
        $response['message'] = "Anda sedang bekerja";
    }else {
        $response['message'] = "Anda sedang tidak bekerja";
    }

    if ($status == 1) {
        $response['text_status'] = "Aktif";
    }else {
        $response['text_status'] = "Tidak Aktif";
    }

    $response['driver_status'] = (int) $status;

}else {
    $response['response'] = 400;
    $response['status'] = false;
    $response['message'] = "Pastikan parameter anda terisi";
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
