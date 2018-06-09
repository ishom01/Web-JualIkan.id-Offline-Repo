<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['user_level']) && isset($_POST['search'])) {

        //do something when right
        $user_level = $_POST['user_level'];
        $search  = $_POST['search'];

        $fish = array();
        $sqlFish = "SELECT * FROM articel WHERE articel_user_level_id = '$user_level' AND articel_name LIKE '%{$search}%'";
        $resultFish = $connect->query($sqlFish);
        while ($row = $resultFish->fetch_assoc()) {
            $fish[] = $row;
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil ambil bantuan";
        $response['data'] = $fish;

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
