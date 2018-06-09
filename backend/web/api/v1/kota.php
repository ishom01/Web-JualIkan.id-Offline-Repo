<?php
    include '../connect.php';

    $response = array();

    $fish = array();
    $sqlFish = "SELECT * FROM kota";
    $resultFish = $connect->query($sqlFish);
    while ($row = $resultFish->fetch_assoc()) {
        $fish[] = $row;
    }

    $response['response'] = 200;
    $response['status'] = true;
    $response['message'] = "Berhasil ambil daftar kota";
    $response['data'] = $fish;

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
