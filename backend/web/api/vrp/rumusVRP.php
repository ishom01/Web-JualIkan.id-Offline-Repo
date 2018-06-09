<?php
    include '../connect.php';

    $id_koperasi = 4;

    //variable digunakan untuk menghitung vrp

    //berat pesanan total
    $weightSum = 0;
    $driverWeightSum = 0;

    //array lokasi index
    //ke-0 adalah id_pesanan,
    //ke-1 adalah lat_pesanan,
    //ke-2 adalah lng_pesanan,
    //ke-3 adalah berat_pesanan
    $arrayLocation = array();

    //array lokasi index
    //ke-0 adalah id_driver,
    //ke-1 adalah nama_driver,
    //ke-1 adalah muatan_driver,
    $arrayDriver = array();

    //array jarak idnex
    $arrayJarak = array();

    // fetch data koperasi
    $koperasi = koperasi($id_koperasi);
    echo "<h2 >Sample Menghitung VRP</h2>";

    $loc = array();
    $loc[] = 0;
    $loc[] = floatval($koperasi['koperasi_lat']);
    $loc[] = floatval($koperasi['koperasi_lng']);
    $loc[] = 0;
    $arrayLocation[] = $loc;

    //========================== Nama Koperasi ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Koperasi</h4>";
    echo "<table width = 1200 border =1 style='text-align:center;' >
              <tr>
                  <th> Nama Koperasi </th>
                  <th> Alamat Koperasi </th>
                  <th> Posisi Koperasi </th>
              </tr>
              <tr>
                  <td> ".$koperasi['koperasi_name']."</td>
                  <td> ".$koperasi['koperasi_address']." </td>
                  <td> ".$koperasi['koperasi_lat']." ".$koperasi['koperasi_lng']."</td>
              </tr>
          </table>";

    //========================== Pesanan Koperasi ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Daftar Order</h4>";
    echo "<table width = 1200 border =1 style='text-align:center;' >
              <tr>
                  <th> ID Order </th>
                  <th> Username </th>
                  <th> Location </th>
                  <th> Weight </th>
              </tr>";
    $newResult = pesanan($id_koperasi);
    while ($obj = $newResult->fetch_assoc()){
        $loc = array();
        $loc[] = (int)$obj['id'];
        $loc[] = floatval($obj['lat']);
        $loc[] = floatval($obj['lng']);
        $loc[] = (int)$obj['weight'];
        $weightSum = (int)$obj['weight'] + $weightSum;
        $arrayLocation[] = $loc;
        echo "<tr>
                  <td> ".$obj['id']."</td>
                  <td> ".$obj['username']." </td>
                  <td> ".$obj['lat']." ".$obj['lng']."</td>
                  <td> ".$obj['weight']." KG </td>
              </tr>";
    }
        echo "<tr>
                  <td></td>
                  <td></td>
                  <td><b>Total</b></td>
                  <td><b>".$weightSum." KG</b> </td>
              </tr>";
    echo "</table>";

    //========================== Profile Driver ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Daftar Order</h4>";
    echo "<table width = 1200 border =1 style='text-align:center;' >
              <tr>
                  <th> ID Driver </th>
                  <th> Driver </th>
                  <th> Weight </th>
              </tr>";
    $driver = driver($id_koperasi);
    while ($obj = $driver->fetch_assoc()){

        $obj2 = array();
        $obj2[] = $obj['driver_id'];
        $obj2[] = $obj['driver_full_name'];
        $obj2[] = (int)$obj['driver_vehicle_weight'];

        $driverWeightSum = $obj2[2] + $driverWeightSum;
        $arrayDriver[] = $obj2;

        echo "<tr>
                  <td> ".$obj['driver_id']."</td>
                  <td> ".$obj2[1]." </td>
                  <td> ".$obj2[2]." KG </td>
              </tr>";
    }
        echo "<tr>
                  <td></td>
                  <td><b>Total</b></td>
                  <td><b>".$driverWeightSum." KG</b> </td>
              </tr>";
    echo "</table>";

    //========================== menampilkan Jarak dan Berat Koperasi ================================//

    echo "<h4 style='margin-bottom:10px'>Tabel Distance and Weight</h4>";
    echo "<table width = 1200 border =1 style='text-align:center;' >
              <tr>
                  <td> Asal \ Tujuan </td>
                  <td> Koperasi </td>
                  ";
                  $newResult = pesanan(1);
                  while ($obj = $newResult->fetch_assoc()){
                      echo "<td> ID Order " . $obj['id'] . "</td>";
                  }
    echo "<td> Berat </td> </tr>";
    for ($i=0; $i < count($arrayLocation) ; $i++) {
        echo "<tr>";
        echo "<td> ID Order ". $arrayLocation[$i][0] ." </td>";
        for ($j=0; $j < count($arrayLocation); $j++) {
            echo "<td> ". countDistance($arrayLocation[$i][1], $arrayLocation[$i][2], $arrayLocation[$j][1], $arrayLocation[$j][2]) ." </td>";
        }
        echo "<td> ". $arrayLocation[$i][3] ." KG</td>";
        echo "</tr>";
    }
    echo "</table>";

    //============= menghitung route menggunakan beberapa metode =============//
    $routeByDistanceResult = countVRPByDistance($arrayLocation, $arrayDriver, $weightSum);
    // $routeByWeightResult = countVRPByWeight(sortByWeight($arrayLocation), $arrayDriver, $weightSum);
    $routeByWeightResult1 = countVRPByWeight($arrayLocation, $arrayDriver, $weightSum);
    $routeByWeightAndDistanceResult = countVRPByWeightAndDistance($arrayLocation, $arrayDriver, $weightSum);
    $routePPResult  = countPPRoute($arrayLocation, $arrayDriver, $weightSum);

    displayRouteTabel($routePPResult, "Route Pengiriman Pulang Pergi");
    displayRouteTabel($routeByDistanceResult, "Route Pengiriman Menggunakan VRP by Distance");
    // displayRouteTabel($routeByWeightResult, "Route Pengiriman Menggunakan VRP by Weight with Weight Sorting");
    displayRouteTabel($routeByWeightResult1, "Route Pengiriman Menggunakan VRP by Weight");
    displayRouteTabel($routeByWeightAndDistanceResult, "Route Pengiriman Menggunakan VRP by Weight and Distance");
?>

<?php

    function koperasi($id){
        include '../connect.php';
        $sql = "SELECT * FROM user_koperasi WHERE koperasi_id = '$id'";
        $result = $connect->query($sql);
        return $result->fetch_assoc();
    }

    function driver($id){
        include '../connect.php';
        $sql = "SELECT * FROM user_driver WHERE driver_koperasi_id = '$id'";
        return $connect->query($sql);
    }

    function pesanan($id){
        include '../connect.php';
        $sql = "SELECT * FROM order_example";
        return $connect->query($sql);
    }

    function countDistance($lat1, $lng1, $lat2, $lng2){
        if (($lat1 == $lat2) && ($lng1 == $lng2)) {
            return 0;
        }else {
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
    }

    function countVRP($array, $driver, $weightSum){
        $i = 0;
        $searchIndex = 0;

        $choosen = array();

        $result = array();

        echo "</br>";
        while ($weightSum > 0){

            //lop by driver
            $indexDriver = 0;

            while ($indexDriver < count($driver)){


                $driverWeight = $driver[$indexDriver][2];

                $searchIndex = 0;

                $route = array();
                $routeAll = array();

                $routeAll[] = 0;

                // $route[] = 0;

                while ($driverWeight > 0) {
                    echo "Cari dari : ". $searchIndex . " | Dengan Berat : " . $array[$searchIndex][3] . " kg</br>";
                    echo "Nama Driver : " . $driver[$indexDriver][1] . "</br>";

                    $object = array();

                    $dis = 9999999999;
                    $index = 0;

                    for ($j=0; $j < count($array); $j++) {
                        if ($searchIndex != $j && $j != 0) {
                            $bol = true;
                            for ($k=0; $k < count($choosen); $k++) {
                                if ($choosen[$k] == $array[$j][0]) {
                                    $bol = false;
                                }
                            }
                            if ($bol) {
                                $cDis = countDistance($array[$searchIndex][1], $array[$searchIndex][2], $array[$j][1], $array[$j][2]);
                                if ($dis > $cDis) {
                                    $dis = $cDis;
                                    $index = $j;
                                }
                                echo "" . $j . "</br>";
                            }

                        }
                    }

                    // echo "choosen : ". $index . " | Dis : " . $dis . "</br>";

                    $object['route'] = $searchIndex . "->" . $index;
                    $object['distance'] = $dis;

                    $bol = true;
                    for ($k=0; $k < count($choosen); $k++) {
                        if ($choosen[$k] == $array[$index][0]) {
                            $bol = false;
                        }
                    }

                    echo "Muatan : " . $driverWeight . "KG | Berat : " . $array[$index][3] . "KG</br>";

                    if ($bol && $driverWeight > $array[$index][3] && $index != 0) {
                        $routeAll[] = $index;
                        $route[] = $object;

                        $choosen[] = $array[$index][0];
                        $searchIndex = $index;

                        $driverWeight = $driverWeight - $array[$searchIndex][3];
                        $weightSum = $weightSum - $array[$searchIndex][3];
                    }
                    else {
                        $driverWeight = 0;
                        $indexDriver++;
                        echo "Reset</br></br>";
                    }
                }

                $object['route'] = $searchIndex . "->0";
                $object['distance'] = countDistance($array[$searchIndex][1], $array[$searchIndex][2], $array[0][1], $array[0][2]);
                $route[] = $object;

                $routeAll[] = 0;

                $result_item  = array();
                $result_item['route_all'] = $routeAll;
                $result_item['driver'] = $driver[$indexDriver-1];
                $result_item['route_item'] = $route;

                $result[] = $result_item;

                echo "Count Choosen : " . count($choosen) . " | Count Pesanan : " . count($array) . "</br>";

                if (count($choosen) < count($array) - 1) {
                    if ($indexDriver == count($driver)) {
                        $indexDriver = 0;
                    }
                }else {
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                    $indexDriver++;
                }

                echo "Index Driver : ". $indexDriver . "</br >";


                echo json_encode($choosen);
                echo "</br>";
                echo "</br>";

            }

            echo "</br>Weight Sum  : " .$weightSum . "</br>";

            // $dis = 9999999999;
            // for ($j=0; $j < count($array); $j++) {
            //     if($i != $j){
            //         if ($dis > countDistance($array[$i][1], $array[$i][2], $array[$j][1], $array[$j][2])) {
            //             $dis = countDistance($array[$i][1], $array[$i][2], $array[$j][1], $array[$j][2]);
            //         }
            //     }
            // }
            //
            // // echo $i . "    ";
            // // echo "berat " . $weightSum . "</br>";
            // // echo "dis : ". $dis . "</br>";
            // // echo "</br>";
            // $weightSum = $weightSum - $array[$i][3];
            // $i++

            ;
        }

        echo "Result : VRP  </br>";
        echo json_encode($result);
    }

    function countVRPByDistance($array, $driver, $weightSum){

        $choosen = array();
        $result = array();

        $i = 0;
        $searchIndex = 0;

        while ($weightSum > 0){

            //lop by driver
            $indexDriver = 0;

            while ($indexDriver < count($driver)){

                $driverWeight = $driver[$indexDriver][2];

                $route = array();
                $routeAll = array();
                $idPemesanan = array();

                //digunakan untuk menentukan index pemesanan sekarang
                $index = 0;
                $routeAll[] = 0;
                $total_route = 0;
                $total_berat = 0;

                while ($driverWeight > 0) {

                    $object = array();

                    $dis = 9999999999;
                    //digunakan menentukan index posisi uang akan dicari
                    $searchIndex = 0;

                    // proses pencarian index
                    for ($j=0; $j < count($array); $j++) {

                        //mencaari apapkah index udah digunakan atau belum
                        if ($index != $j && $j != 0) {

                            //proses pengecheckan apakah index udah digunakan atau tidak
                            $bol = true;
                            for ($k=0; $k < count($choosen); $k++) {
                                if ($choosen[$k] == $array[$j][0]) {
                                    $bol = false;
                                }
                            }

                            // jika belum digunakan
                            if ($bol) {
                                //menghitung rute dari titik index ke titik index yang dicari
                                $cDis = countDistance($array[$index][1], $array[$index][2], $array[$j][1], $array[$j][2]);
                                //pengecekan apakah rute tersebut rute terdekat ?
                                if ($dis > $cDis) {
                                    $dis = $cDis;
                                    $searchIndex = $j;
                                }
                            }

                        }
                    }

                    //check apakah berat pesanan tersebut tidak melebihi dari berat driver
                    if ($driverWeight >= $array[$searchIndex][3] && $searchIndex != 0) {

                        $object['route'] = $array[$index][0] . " -> " . $array[$searchIndex][0];
                        $object['distance'] = $dis;
                        $object['weight'] = $array[$searchIndex][3];

                        $total_route = $total_route + $object['distance'];
                        $total_berat = $total_berat + $object['weight'];

                        $routeAll[] = $array[$searchIndex][0];
                        $idPemesanan[] = $array[$searchIndex][0];
                        $route[] = $object;

                        $choosen[] = $array[$searchIndex][0];
                        $index = $searchIndex;

                        $driverWeight = $driverWeight - $array[$searchIndex][3];
                        $weightSum = $weightSum - $array[$searchIndex][3];

                        $driver_info['id'] = $driver[$indexDriver][0];
                        $driver_info['name'] = $driver[$indexDriver][1];
                    }
                    else {
                        $driverWeight = 0;
                        $indexDriver++;
                    }
                }

                $object['route'] = $index . " -> 0";
                $object['distance'] = countDistance($array[$index][1], $array[$index][2], $array[0][1], $array[0][2]);
                $object['weight'] = 0;

                $route[] = $object;

                $routeAll[] = 0;

                $result_item  = array();
                $result_item['id_order'] = $idPemesanan;
                $result_item['route_all'] = $routeAll;

                $result_item['total_route'] = $total_route;
                $result_item['total_weight'] = $total_berat;


                $result_item['driver'] = $driver_info;

                $result_item['route_item'] = $route;

                $result[] = $result_item;

                if (count($choosen) > count($array) - 1) {
                    if ($indexDriver == count($driver)) {
                        $indexDriver = 0;
                    }
                }else {
                    $indexDriver++;
                }
            }
        }

        // echo json_encode($result);
        return $result;
    }

    function countVRPByWeight($arrayPemesanan, $arrayDriver, $weightSum){
        $choosen = array();
        $result = array();

        $i = 0;
        $searchIndex = 0;

        while ($weightSum > 0){

            //lop by driver
            $indexDriver = 0;

            while ($indexDriver < count($arrayDriver)){
                $driverWeight = $arrayDriver[$indexDriver][2];

                $route = array();
                $routeAll = array();
                $idPemesanan = array();

                //digunakan untuk menentukan index pemesanan sekarang
                $index = 0;
                $total_route = 0;
                $total_berat = 0;
                $routeAll[] = 0;

                while ($driverWeight > 0) {

                    $object = array();
                    $dis = 9999999999;
                    //digunakan menentukan index posisi uang akan dicari
                    $searchIndex = 0;

                    // proses pencarian index
                    for ($j=0; $j < count($arrayPemesanan); $j++) {

                        //mencaari apapkah index udah digunakan atau belum
                        if ($index != $j && $j != 0) {

                            //proses pengecheckan apakah index udah digunakan atau tidak
                            $bol = true;
                            for ($k=0; $k < count($choosen); $k++) {
                                if ($choosen[$k] == $arrayPemesanan[$j][0]) {
                                    $bol = false;
                                }
                            }

                            // jika belum digunakan
                            if ($bol) {
                                //menghitung rute dari titik index ke titik index yang dicari
                                $cDis = countDistance($arrayPemesanan[$index][1], $arrayPemesanan[$index][2], $arrayPemesanan[$j][1], $arrayPemesanan[$j][2]);
                                //pengecekan apakah rute tersebut rute terdekat ?
                                if ($driverWeight >= $arrayPemesanan[$j][3]) {
                                    $dis = $cDis;
                                    $searchIndex = $j;
                                    break;
                                }
                            }

                        }
                    }


                    //check apakah berat pesanan tersebut tidak melebihi dari berat driver
                    if ($searchIndex != 0) {

                        $object['route'] = $arrayPemesanan[$index][0] . " -> " . $arrayPemesanan[$searchIndex][0];
                        $object['distance'] = $dis;
                        $object['weight'] = $arrayPemesanan[$searchIndex][3];

                        $total_route = $total_route + $object['distance'];
                        $total_berat = $total_berat + $object['weight'];

                        $routeAll[] = $arrayPemesanan[$searchIndex][0];
                        $idPemesanan[] = $arrayPemesanan[$searchIndex][0];
                        $route[] = $object;

                        $choosen[] = $arrayPemesanan[$searchIndex][0];
                        $index = $searchIndex;

                        $driverWeight = $driverWeight - $arrayPemesanan[$searchIndex][3];
                        $weightSum = $weightSum - $arrayPemesanan[$searchIndex][3];

                        $driver_info['id'] = $arrayDriver[$indexDriver][0];
                        $driver_info['name'] = $arrayDriver[$indexDriver][1];

                    }
                    else {
                        $driverWeight = 0;
                        $indexDriver++;
                    }
                }

                if ($index != 0) {
                    $object['route'] = $arrayPemesanan[$index][0] . " -> 0";
                    $object['distance'] = countDistance($arrayPemesanan[$index][1], $arrayPemesanan[$index][2], $arrayPemesanan[0][1], $arrayPemesanan[0][2]);
                    $object['weight'] = 0;
                    $route[] = $object;

                    $routeAll[] = 0;

                    $result_item  = array();
                    $result_item['id_order'] = $idPemesanan;
                    $result_item['route_all'] = $routeAll;
                    $result_item['total_route'] = $total_route;
                    $result_item['total_weight'] = $total_berat;

                    $result_item['driver'] = $driver_info;

                    $result_item['route_item'] = $route;

                    $result[] = $result_item;
                }

                if (count($choosen) > count($arrayPemesanan) - 1) {
                    if ($indexDriver == count($arrayDriver)) {
                        $indexDriver = 0;
                    }
                }else {
                    $indexDriver++;
                }
            }
        }
        return $result;
    }

    function countVRPByWeightAndDistance($arrayPemesanan, $arrayDriver, $weightSum){
        $choosen = array();
        $result = array();

        $i = 0;
        $searchIndex = 0;

        while ($weightSum > 0){

            //lop by driver
            $indexDriver = 0;

            while ($indexDriver < count($arrayDriver)){
                $driverWeight = $arrayDriver[$indexDriver][2];

                $route = array();
                $routeAll = array();
                $idPemesanan = array();

                //digunakan untuk menentukan index pemesanan sekarang
                $index = 0;
                $total_route = 0;
                $total_berat = 0;
                $routeAll[] = 0;

                while ($driverWeight > 0) {

                    $object = array();

                    $dis = 9999999999;
                    //digunakan menentukan index posisi uang akan dicari
                    $searchIndex = 0;

                    // proses pencarian index
                    for ($j=0; $j < count($arrayPemesanan); $j++) {

                        // echo "$j </br>";

                        //mencaari apapkah index udah digunakan atau belum
                        if ($index != $j && $j != 0) {

                            //proses pengecheckan apakah index udah digunakan atau tidak
                            $bol = true;
                            for ($k=0; $k < count($choosen); $k++) {
                                if ($choosen[$k] == $arrayPemesanan[$j][0]) {
                                    $bol = false;
                                }
                            }

                            // jika belum digunakan
                            if ($bol) {
                                //menghitung rute dari titik index ke titik index yang dicari
                                $cDis = countDistance($arrayPemesanan[$index][1], $arrayPemesanan[$index][2], $arrayPemesanan[$j][1], $arrayPemesanan[$j][2]);
                                //pengecekan apakah rute tersebut rute terdekat ?
                                // echo "Driver Weight = $driverWeight</br>";
                                if ($driverWeight >= $arrayPemesanan[$j][3] && $cDis < $dis) {
                                    $dis = $cDis;
                                    $searchIndex = $j;
                                    // echo "$index | $searchIndex | " . $arrayPemesanan[$j][3] . " KG | $cDis </br>";
                                }
                            }

                        }
                    }

                    //check apakah berat pesanan tersebut tidak melebihi dari berat driver
                    if ($searchIndex != 0) {
                        $object['route'] = $arrayPemesanan[$index][0] . " -> " . $arrayPemesanan[$searchIndex][0];
                        $object['distance'] = $dis;
                        $object['weight'] = $arrayPemesanan[$searchIndex][3];

                        $total_route = $total_route + $object['distance'];
                        $total_berat = $total_berat + $object['weight'];

                        $routeAll[] = $arrayPemesanan[$searchIndex][0];
                        $idPemesanan[] = $arrayPemesanan[$searchIndex][0];
                        $route[] = $object;

                        $choosen[] = $arrayPemesanan[$searchIndex][0];
                        $index = $searchIndex;

                        $driverWeight = $driverWeight - $arrayPemesanan[$searchIndex][3];
                        $weightSum = $weightSum - $arrayPemesanan[$searchIndex][3];

                        $driver_info['id'] = $arrayDriver[$indexDriver][0];
                        $driver_info['name'] = $arrayDriver[$indexDriver][1];
                    }
                    else {
                        $driverWeight = 0;
                        $indexDriver++;
                    }
                }

                $object['route'] = $index . " -> 0";
                $object['distance'] = countDistance($arrayPemesanan[$index][1], $arrayPemesanan[$index][2], $arrayPemesanan[0][1], $arrayPemesanan[0][2]);
                $object['weight'] = 0;
                $route[] = $object;

                $routeAll[] = 0;

                $result_item  = array();
                $result_item['id_order'] = $idPemesanan;
                $result_item['route_all'] = $routeAll;
                $result_item['total_route'] = $total_route;
                $result_item['total_weight'] = $total_berat;

                $result_item['driver'] = $driver_info;

                $result_item['route_item'] = $route;

                $result[] = $result_item;

                if (count($choosen) > count($arrayPemesanan) - 1) {
                    if ($indexDriver == count($arrayDriver)) {
                        $indexDriver = 0;
                    }
                }else {
                    $indexDriver++;
                }
            }
        }

        // echo json_encode($result);
        return $result;
    }

    function countPPRoute($array, $driver, $weightSum){

        $result = array();

        $i = 0;
        $searchIndex = 0;

        $driver_id = 0;
        //start
        for ($i=1; $i < count($array); $i++) {
            $result_item = array();

            $route = array();
            $routeAll = array();
            $idPemesanan = array();

            $idPemesanan[] = $array[$i][0];
            $routeAll[] = 0;
            $routeAll[] = $array[$i][0];
            $routeAll[] = 0;

            $driver_info['id'] = $driver[$driver_id][0];
            $driver_info['name'] = $driver[$driver_id][1];

            $total_route = 0;
            $total_berat = 0;

            $object = array();
            $object['route'] = "0 -> " . $array[$i][0];
            $object['distance'] = countDistance($array[0][1], $array[0][2], $array[$i][1], $array[$i][2]);
            $object['weight'] = $array[$i][3];

            $total_route = $total_route + $object['distance'];
            $total_berat = $total_berat + $object['weight'];

            $object1 = array();
            $object1['route'] = $array[$i][0] . " -> 0";
            $object1['distance'] = countDistance($array[$i][1], $array[$i][2], $array[0][1], $array[0][2]);
            $object1['weight'] = 0;

            $total_route = $total_route + $object1['distance'];
            $total_berat = $total_berat + $object1['weight'];

            $route[] = $object;
            $route[] = $object1;


            $result_item['id_order'] = $idPemesanan;
            $result_item['route_all'] = $routeAll;

            $result_item['driver'] = $driver_info;

            $result_item['route_item'] = $route;

            $result_item['total_route'] = $total_route;
            $result_item['total_weight'] = $total_berat;

            $result[] = $result_item;

            $driver_id++;
            if ($driver_id == count($driver)) {
                $driver_id = 0;
            }
        }
        //end

        // echo json_encode($result);
        return $result;
    }

    function displayRouteTabel($routeResult, $title){
        echo "<h4 style='margin-bottom:10px'>".$title."</h4>";
        echo "<table width = 1200 border =1 style='text-align:center;' >
                  <tr>
                      <td>ID Pengiriman</td>
                      <td> ID Pemesanan </td>
                      <td> ID Driver </td>
                      <td> Route </td>
                      <td> Deskripsi Route </td>
                      <td> Jarak </td>
                      <td> Berat </td>
                      <td> Total Jarak </td>
                      <td> Total Berat </td>
                  </tr>";
        $total_keseluruhan = 0;
        $total_berat_keseluruhan = 0;
        for ($i=0; $i < count($routeResult) ; $i++) {
            echo "<tr>";
            $index = $i + 1;
            $total_berat_keseluruhan = $total_berat_keseluruhan + $routeResult[$i]["total_weight"];
            echo "<td> Pengiriman Ke-". $index ." </td>";
            echo "<td>
                      <table border=1 style='text-align:center; width:100%;'>
                          <tr>";
                              for ($j=0; $j < count($routeResult[$i]["id_order"]); $j++) {
                                  echo "<tr><td> ID Pemesanan ". $routeResult[$i]["id_order"][$j] ."</tr></td>";
                              }
                          echo "</tr>
                      </table>
                  </td>";
            echo "<td>". $routeResult[$i]["driver"]["name"] ."</td>";
            echo "<td>";
                  $string = "";
                  for ($j=0; $j < count($routeResult[$i]["route_all"]) ; $j++) {
                      if ($j == (count($routeResult[$i]["route_all"])-1)) {
                          $string = $string . $routeResult[$i]["route_all"][$j];
                      }else{
                          $string = $string . $routeResult[$i]["route_all"][$j] . " -> ";
                      }
                  }
            echo $string . "</td>";

            echo "<td>
                      <table border=1 style='text-align:center; width:100%;'>
                          <tr>";
                              for ($j=0; $j < count($routeResult[$i]["route_item"]); $j++) {
                                  echo "<tr><td>". $routeResult[$i]["route_item"][$j]["route"] ."</tr></td>";
                              }
                          echo "</tr>
                      </table>
                  </td>";

            echo "<td>
                      <table border=1 style='text-align:center; width:100%;'>
                          <tr>";
                              for ($j=0; $j < count($routeResult[$i]["route_item"]); $j++) {
                                  echo "<tr><td>". (int) $routeResult[$i]["route_item"][$j]["distance"] ." Meter</tr></td>";
                              }
                          echo "</tr>
                      </table>
                  </td>";

            echo "<td>
                      <table border=1 style='text-align:center; width:100%;'>
                          <tr>";
                              for ($j=0; $j < count($routeResult[$i]["route_item"]); $j++) {
                                  echo "<tr><td>". $routeResult[$i]["route_item"][$j]["weight"] ." KG</tr></td>";
                              }
                          echo "</tr>
                      </table>
                  </td>";

            echo "<td>";
                  $total_route = 0;
                  for ($j=0; $j < count($routeResult[$i]["route_item"]); $j++) {
                      $total_route = $total_route + $routeResult[$i]["route_item"][$j]["distance"];
                  }
                  $total_keseluruhan = (int) $total_keseluruhan + $total_route;
            echo (int) $total_route . " Meter</td>";

            echo "<td> " . $routeResult[$i]["total_weight"] ." KG </td>";
            // echo "<td> Pengiriman". $routeResult[$i]['route_all'] ." </td>";
            echo "</tr>";

        }
        echo "<tr>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                <td><b> Total Jarak & Berat</b></td>
                <td><b> ".(int) $total_keseluruhan." Meter </b></td>
                <td><b> ".$total_berat_keseluruhan." KG </b></td>
            </tr>";
        echo "</table>";
    }

    function sortByWeight($array){
        $arrayTemp = array();
        $tempId = array();
        for ($i=1; $i < count($array); $i++) {
            $min = 999999999999;
            for ($j=1; $j < count($array); $j++) {
                $bol = true;
                for ($k = 0; $k < count($tempId); $k++) {
                    if ($tempId[$k] == $j) {
                        $bol = false;
                        break;
                    }
                }
                if ($bol && $min > $array[$j][3]) {
                    $index = $j;
                    $min = $array[$j][3];
                }
            }
            $tempId[] = $index;
        }

        $arrayTemp[] = $array[0];
        for ($i=0; $i < count($tempId); $i++) {
            $arrayTemp[] = $array[$tempId[$i]];
        }

        // echo json_encode($arrayTemp);
        return $arrayTemp;
    }

    function getDirection($latFirst, $lngFirst, $latLast, $lngLast){
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, "https://maps.googleapis.com/maps/api/directions/json?key=AIzaSyBoFfYEuwzXaVwF07dt30KvYZM9vJXUGb0&origin=-".$latFirst.",".$lngFirst."&destination=-".$latLast.",".$lngLast."&sensor=true&mode=driving" );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec( $ch );
        echo $result;
        curl_close( $ch );
    }
?>
