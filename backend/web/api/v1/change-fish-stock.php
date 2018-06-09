<?php

  function changeStock($fish_id, $status){
      include '../connect.php';

      $sql = "SELECT * FROM fish WHERE fish_id = '$fish_id'";
      $result = $connect->query($sql);
      $row = $result->fetch_assoc();

      $stock = $row['fish_stock'];

      if ($status) {
          $stock = $stock - 1;
      }else {
          $stock = $stock + 1;
      }

      $sql1 = "UPDATE fish SET fish_stock = '$stock' WHERE fish_id = '$fish_id'";
      $connect->query($sql1);
  }

?>
