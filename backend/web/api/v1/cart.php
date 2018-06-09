<?php
    include '../connect.php';
    include 'change-fish-stock.php';

    $response = array();

    if (isset($_POST['id_user']) && isset($_POST['cart_id']) && isset($_POST['jumlah'])) {
        $cart_id = $_POST['cart_id'];
        $jumlah  = $_POST['jumlah'];

        if ($cart_id != 0) {

            $sql = "SELECT* FROM cart WHERE cart_id = '$cart_id'";
            $result = $connect->query($sql);
            $row = $result->fetch_assoc();

            $qty_before = $row['cart_fish_qty'];
            $fish_id = $row['cart_fish_id'];

            if ($qty_before == 0) {
                $response['response'] = 200;
                $response['status'] = false;
                $response['message'] = "Stock ikan habis";
            }else {
                if ($qty_before < $jumlah) {
                    /// berarti keranjang ditambahkan
                    changeStock($fish_id, true);
                }else {
                    /// berarti keranjang dikurangkan
                    changeStock($fish_id, false);
                }

                if ($jumlah != 0) {
                    $sql = "UPDATE cart SET cart_fish_qty = '$jumlah' WHERE cart_id = '$cart_id'";
                }else {
                    $sql = "DELETE FROM cart WHERE cart_id = '$cart_id'";
                }

                if ($connect->query($sql)) {
                    $keranjang = array();
                    $id_user = $_POST['id_user'];
                    $sql = "SELECT keranjang.*, ikan.* FROM cart as keranjang, fish as ikan WHERE keranjang.cart_status = 0 and keranjang.cart_user_id = '$id_user' and ikan.fish_id = keranjang.cart_fish_id";
                    $result = $connect->query($sql);
                    $total = 0;
                    while ($row = $result->fetch_assoc()){
                        $object = array();
                        $object['id'] = $row['cart_id'];
                        $object['fish_id'] = $row['cart_fish_id'];
                        $object['image'] = $row['fish_image'];
                        $object['name'] = $row['fish_name'];
                        $object['price'] = (int)$row['fish_price'];
                        $object['qty'] = (int)$row['cart_fish_qty'];
                        $object['total_price'] = $object['price'] * $object['qty'];
                        $total = $object['total_price'] + $total;
                        $keranjang[] = $object;
                    }
                    $response['response'] = 200;
                    $response['status'] = true;
                    $response['message'] = "Berhasil menggubah data keranjang";
                    $response['data'] = $keranjang;
                    $response['total'] = $total;
                }else {
                    $response['response'] = 200;
                    $response['status'] = false;
                    $response['message'] = "Gagal mengubah data keranjang";
                }
            }

        }else {
            $keranjang = array();
            $id_user = $_POST['id_user'];
            $sql = "SELECT keranjang.*, ikan.* FROM cart as keranjang, fish as ikan WHERE keranjang.cart_status = 0 and keranjang.cart_user_id = '$id_user' and ikan.fish_id = keranjang.cart_fish_id";
            $result = $connect->query($sql);
            $total = 0;
            while ($row = $result->fetch_assoc()){
                $object = array();
                $object['id'] = $row['cart_id'];
                $object['fish_id'] = $row['cart_fish_id'];
                $object['image'] = $row['fish_image'];
                $object['name'] = $row['fish_name'];
                $object['price'] = (int)$row['fish_price'];
                $object['qty'] = (int)$row['cart_fish_qty'];
                $object['total_price'] = $object['price'] * $object['qty'];
                $total = $object['total_price'] + $total;
                $keranjang[] = $object;
            }
            $response['response'] = 200;
            $response['status'] = true;
            $response['message'] = "Berhasil ambil data";
            $response['data'] = $keranjang;
            $response['total'] = $total;
        }
    }else {
        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
