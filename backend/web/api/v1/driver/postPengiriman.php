<?php

  $url = "http://localhost/";

  $id = $_GET['id'];
  // echo $id;
  $array = json_decode($id);

  for ($i=0; $i < count($array); $i++) {
      // echo $array[$i]->driver;
      // echo $i;
      save($array[$i]->order, $array[$i]->driver,$array[$i]->koperasi,$array[$i]->waktu,$array[$i]->jarak);
  }

  // echo json_encode($array, JSON_PRETTY_PRINT);

  function save($arrayOrderId, $driverId, $koperasiId, $waktu, $jarak){
      include '../../connect.php';

      $order_id = json_encode($arrayOrderId);

      for ($i=0; $i < count($arrayOrderId); $i++) {
          updatePemesanan($arrayOrderId[$i]);
      }

      //model mengambil data driver
      $driver = driver($driverId);
      $code = rand(000000, 999999);
      $trackId = $driver['driver_track_id'];
      $phone_id = $driver['driver_device_id'];
      $payment = $jarak * 600 / 1000;

      date_default_timezone_set('Asia/Jakarta');
      $date = date('Y-m-d H:m:s');

      $sql = "INSERT INTO delivery (
                  delivery_code,
                  delivery_order_id,
                  delivery_order_koperasi_id,
                  delivery_driver_id,
                  delivery_driver_track_id,
                  delivery_time_depart,
                  delivery_time_arrival,
                  delivery_travel_time,
                  delivery_travel_distance,
                  delivery_payment,
                  delivery_status
              ) VALUES (
                  '$code',
                  '$order_id',
                  '$koperasiId',
                  '$driverId',
                  '$trackId',
                  '$date',
                  '$date',
                  '$waktu',
                  '$jarak',
                  '$payment',
                  0
              )";

              echo $sql;

      $connect->query($sql);
      $delivery_id = $connect->insert_id;
      postNotification(count($arrayOrderId), $driverId, $delivery_id, $phone_id);
  }

  function pemesanan($id){
      include '../../connect.php';
      $sql = "SELECT * FROM `order` WHERE order_id = '$id'";
      $result = $connect->query($sql);
      return $result->fetch_assoc();
  }

  function updatePemesanan($id){
      include '../../connect.php';
      $sql = "UPDATE `order` SET order_status = 2 WHERE order_id = '$id'";
      $connect->query($sql);
  }

  function driver($id){
      include '../../connect.php';
      $sql = "SELECT * FROM user_driver WHERE driver_id = '$id'";
      $result = $connect->query($sql);
      return $result->fetch_assoc();
  }

  function postNotification($jumalah_order, $driver_id, $delivery_id, $idPhone){
      $message = $jumalah_order . " Order Siap Dikirim";
      $title = "JualIkan Driver";

      $path = 'https://fcm.googleapis.com/fcm/send';
	    $server = "AAAAqJsb9OQ:APA91bHfkeiN0pol3m2Hj1Z86fbhlj3mNwBk4f_-0OZEXEWigig5sjlh_yviCvxXQv3aUu5riYfxP74d4_6kXkio5jlnm04UG11mlxwW8DZr8vM84trQ8IfkQvv-oOA6KKHm9k9X0ZQK";

      $headers = array(
        	'Authorization:key='. $server,
        	'Content-Type:application/json'
      );

      $msg = array(
    	     'body' => $message,
    	     'title' => $title,
           'click_action' => "DELIVERY_NOTIF"
    	);

      $data = array(
          'driver_id' => $driver_id,
          'delivery_id' => $delivery_id
      );

      $fields = array(
    		'to' => $idPhone,
    		'notification' => $msg,
    		'data' => $data
    	);

      $ch = curl_init();
    	curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
    	curl_setopt( $ch,CURLOPT_POST, true );
    	curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    	curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    	$result = curl_exec($ch );
    	curl_close( $ch );

      header('Location:'."http://".$_SERVER['HTTP_HOST']."/jualikan.id/order/hariini");
  }

  function udpateSaldoDriver($delivery_id, $driver_id, $level, $value){
      include '../../connect.php';

      $title = "Pembayaran Order-". $delivery_id;

      $sql = "INSERT INTO saldo_history (
                saldo_history_title,
                saldo_user_id,
                saldo_user_level,
                saldo_value)
              VALUES (
                '$title',
                '$driver_id',
                '$level',
                '$value'
              )";

      if ($connect->query($sql)) {
          echo "sukses";
      }else {
          echo "gagal";
      }
  }

?>
