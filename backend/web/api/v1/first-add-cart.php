<?php
    include '../connect.php';
    include 'change-fish-stock.php';


    $response = array();

    if (isset($_POST['fish_id']) && isset($_POST['user_id']) && isset($_POST['lat']) && isset($_POST['lng']) && isset($_POST['koperasi_id'])) {
        //do something when right

        $fish_id = $_POST['fish_id'];
        $user_id = $_POST['user_id'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $koperasi_id = $_POST['koperasi_id'];

        $maxDistance = 50000;
        $total = 1;
        $status = 0;

        $sql = "SELECT * FROM cart WHERE cart_user_id = '$user_id' AND cart_fish_id = '$fish_id' AND cart_status = '$status'";
        $result = $connect->query($sql);
        $size = $result->num_rows;

        if ($size == 0) {
            $checkStatusKoperasi = true;
            $checkStockIkan = true;

            $sql1 = "SELECT keranjang.*, ikan.* FROM cart as keranjang, fish as ikan WHERE keranjang.cart_user_id = '$user_id' AND keranjang.cart_status = '$status' and ikan.fish_id = keranjang.cart_fish_id";
            $result1 = $connect->query($sql1);

            while ($row1 = $result1->fetch_assoc()){
                if ($koperasi_id != (int)$row1['fish_koperasi_id']) {
                    $checkStatusKoperasi = false;
                }
                if ($row1['fish_stock'] == 0) {
                    $checkStockIkan = false;
                }
            }

            if ($checkStatusKoperasi && $checkStockIkan) {
                ///
                $sql1 = "SELECT * FROM user_koperasi WHERE koperasi_id = '$koperasi_id'";
                $result1 = $connect->query($sql1);
                $row1 = $result->num_rows;

                $distance = countDistance(floatval($lat), floatval($lng), floatval($row1['koperasi_lat']), floatval($row1['koperasi_lng']));

                if ($maxDistance < $distance) {
                    $query = "INSERT INTO cart (
                      cart_fish_id,
                      cart_fish_qty,
                      cart_user_id,
                      cart_status) VALUES (
                        '$fish_id',
                        '$total',
                        '$user_id',
                        '$status')";

                    if ($connect->query($query)) {
                        changeStock($fish_id, true);
                        $response['response'] = 200;
                        $response['status'] = true;
                        $response['message'] = "Ikan berhasil ditambahkan pada keranjang";
                    }else {
                        $response['response'] = 200;
                        $response['status'] = false;
                        $response['message'] = "Gagal menambahkan pada keranjang";
                    }
                }else {
                    if (!$checkStatusKoperasi) {
                        $response['response'] = 200;
                        $response['status'] = false;
                        $response['message'] = "Koperasi ikan sangat jauh dengan lokasi anda";
                    }
                    if (!$checkStockIkan) {
                      $response['response'] = 200;
                      $response['status'] = false;
                      $response['message'] = "Mohon maaf stock ikan habis";
                    }
                }
            }else {
                $response['response'] = 200;
                $response['status'] = false;
                $response['message'] = "Anda hanya dapat memesan ikan pada 1 koperasi saja";
            }

        }else {
            $response['response'] = 200;
            $response['status'] = false;
            $response['message'] = "Ikan sudah ditambahkan pada keranjang";
        }

        // $response['response'] = 200;
        // $response['status'] = true;
        // $response['message'] = "Berhasil ambil bantuan";
        // $response['data'] = $fish;
    }else {
        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);

    function countDistance($lat1, $lng1, $lat2, $lng2){
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lng1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lng2);

        $earthRadius = 6371000;

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }
?>
