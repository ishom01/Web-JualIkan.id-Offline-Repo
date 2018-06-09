<?php
    include '../connect.php';

    $response = array();

    if (isset($_POST['search']) &&
        isset($_POST['cat_id'])) {

        //do something when right
        $cat_id = $_POST['cat_id'];
        $search = $_POST['search'];

        $fish = array();

        if (intval($cat_id) == 0) {
            $sqlFish = "SELECT * FROM fish WHERE fish_name LIKE '%{$search}%'  ORDER BY fish_date DESC";
        }else {
            $sqlFish = "SELECT * FROM fish WHERE fish_category_id = '$cat_id' AND fish_name LIKE '%{$search}%' ORDER BY fish_date DESC";
        }
        $resultFish = $connect->query($sqlFish);
        while ($row = $resultFish->fetch_assoc()) {

          //fish category
          $fish_category_id = $row['fish_category_id'];
          $sql1 = "SELECT * FROM fish_category WHERE fish_category_id = '$fish_category_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
              $fish_category_id = $row1['fish_category_name'];
          }

          //fish condition
          $fish_condition_id = $row['fish_condition_id'];
          $sql1 = "SELECT * FROM fish_condition WHERE fish_condition_id = '$fish_condition_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
              $fish_condition_id = $row1['fish_condition_name'];
          }

          //fish size
          $fish_size_id = $row['fish_size_id'];
          $sql1 = "SELECT * FROM fish_size WHERE fish_size_id = '$fish_size_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
              $fish_size_id = $row1['fish_size_name'];
          }

          //fish rating
          $rating = 0;
          $total_rating = 0;
          $fish_id = $row['fish_id'];
          $sql1 = "SELECT * FROM fish_review WHERE fish_id = '$fish_id'";
          $result1 = $connect->query($sql1);
          while ($row1 = $result1->fetch_assoc()) {
            $total_rating++;
            $rating = (int)$rating + (int)$row1["review_jumalh"];
          }

          if ($total_rating != 0) {
              $rating = $rating/$total_rating;
          }

          $fish[] = array(
              'fish_id' => $row['fish_id'],
              'fish_image' => $row['fish_image'],
              'fish_name' => $row['fish_name'],
              'fish_price' => $row['fish_price'],
              'fish_koperasi_id' => $row['fish_koperasi_id'],
              'fish_category_id' => $fish_category_id,
              'fish_condition_id' => $fish_condition_id,
              'fish_size_id' => $fish_size_id,
              'fish_stock' => $row['fish_stock'],
              'fish_rating' => (int)$rating,
              'fish_total_rating' => $total_rating,
              'fish_description' => $row['fish_description'],
              'fish_date' => $row['fish_date'],
          );
        }

        $response['response'] = 200;
        $response['status'] = true;
        $response['message'] = "Berhasil Ambil kategori";
        $response['data'] = $fish;

    }else {

        //do something when false
        $response['response'] = 400;
        $response['status'] = false;
        $response['message'] = "Pastikan parameter anda terisi";
    }

    echo json_encode($response, JSON_PRETTY_PRINT);
?>
