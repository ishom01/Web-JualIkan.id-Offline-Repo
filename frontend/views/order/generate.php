<?php
use frontend\models\UserKoperasi;
$object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
$server  = "http://" . $_SERVER['HTTP_HOST'] . "/jualikan.id/";

?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="http://localhost/jualikan.id/backend/web/js/setMapsnCountVRP.js" ></script> -->
<script src="<?php echo $server ?>backend/web/js/setAfterVRPMap.js" ></script>
<!-- <script src="http://localhost/jualikan.id/backend/web/js/setBeforeVRPMap.js" ></script> -->


<script type="text/javascript">
  // getExampleOrder("<?php echo $object->kopreasi_image ?>", "<?php echo $object->koperasi_name ?>", "<?php echo $object->koperasi_address ?>", "<?php echo $object->koperasi_lat ?>", "<?php echo $object->koperasi_lng ?>");
  // getBeforeExampleOrder("<?php echo $object->kopreasi_image ?>", "<?php echo $object->koperasi_name ?>", "<?php echo $object->koperasi_address ?>", "<?php echo $object->koperasi_lat ?>", "<?php echo $object->koperasi_lng ?>");
  getAfterExampleOrder("<?php echo $object->kopreasi_image ?>", "<?php echo $object->koperasi_name ?>", "<?php echo $object->koperasi_address ?>", "<?php echo $object->koperasi_lat ?>", "<?php echo $object->koperasi_lng ?>");
</script>

<?php
$this->title = 'VRP Route Counting';
?>
<div class="row" style="margin-top:-20px;">
    <div class="col-lg-6 col-xs-12">
        <h4>Before Counting with VRP</h4>
        <div id="map_before" class="mapping" style="height:520px;"></div>
        <div style="text-align: center;">
            <h4 id="txtSwap"><b>0% | Swap/Turn : 0</b></h4>
            <h4 ><b>Result Without VRP :</b></h4>
            <h4 id="txtTime">Time     : 000 menit</h4>
            <h4 id="txtDistance">Distance : 000 KM</h4>
            <h4 id="txtCoast">Coast : Rp. 0</h4>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12">
        <h4>After Counting with VRP</h4>
        <div id="map_result" class="mapping" style="height:520px;"></div>
        <div style="text-align:center;">
            <h4 id="txtTurnCount"><b>0% | Swap/Turn : 0</b></h4>
            <h4><b>Result With VRP :</b></h4>
            <h4 id="txtTimeCount">Time     : 000 menit</h4>
            <h4 id="txtDistanceCount">Distance : 000 KM</h4>
            <h4 id="txtCoastCount">Coast : Rp. 0</h4>
        </div>
    </div>
</div>
<div class="row">
  <h4 id="txtaArray">Array</div>
</div>


<?php


function getCheck(){
    return ;
}
?>
