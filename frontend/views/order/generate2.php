<?php
use frontend\models\UserKoperasi;
$object = UserKoperasi::find()->where(['koperasi_email' => Yii::$app->user->identity->username])->one();
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDIB9n26M5MbDXtw-Hd1pUyh8M1xJHjBI0&sensor=false&callback=initialize"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="http://localhost/jualikan.id/backend/web/js/setMapsnCountVRP.js" ></script> -->
<script src="http://localhost/jualikan.id/backend/web/js/vrp/countVrp.js" ></script>
<!-- <script src="http://localhost/jualikan.id/backend/web/js/setBeforeVRPMap.js" ></script> -->

<style>

#progressbar1 {
    width: 100%;
    background-color: #CACED2;
}
#progressbar {
    width: 10%;
    height: 30px;
    background-color: #3c8dbc;
}
h4 {
  font-size: 14px;
}
h3 {
  font-size: 24px;
}
</style>


<script type="text/javascript">
  // getExampleOrder("<?php echo $object->kopreasi_image ?>", "<?php echo $object->koperasi_name ?>", "<?php echo $object->koperasi_address ?>", "<?php echo $object->koperasi_lat ?>", "<?php echo $object->koperasi_lng ?>");
  // getBeforeExampleOrder("<?php echo $object->kopreasi_image ?>", "<?php echo $object->koperasi_name ?>", "<?php echo $object->koperasi_address ?>", "<?php echo $object->koperasi_lat ?>", "<?php echo $object->koperasi_lng ?>");
  getOrder("<?php echo $object->koperasi_id ?>","<?php echo $object->kopreasi_image ?>", "<?php echo $object->koperasi_name ?>", "<?php echo $object->koperasi_address ?>", "<?php echo $object->koperasi_lat ?>", "<?php echo $object->koperasi_lng ?>");
</script>

<?php
$this->title = 'VRP Route Counting';
?>

<div style="margin-top:-20px;">
    <div id="titlepesanan"></div>
    <div id="pesanan"></div>

    <div id="titledriver"></div>
    <div id="driver"></div>

    <h3 id="titleprogressbar">Loading....</h3>
    <div id="progressbar1">
        <div id="progressbar"></div>
    </div>
    <h4 id="valueBar">0%</h4>

    <div id="titlejarak"></div>
    <div id="jarak"></div>

    <div id="titlepp"></div>
    <div id="mapspp"></div>
    <div id="pp"></div>

    <div id="titlemapdistance"></div>
    <div id="mapsdistance"></div>
    <div id="buttondistance"></div>
    <div id="titledistance"></div>
    <div id="distance"></div>

    <div id="titlemapweight"></div>
    <div id="mapsweight"></div>
    <div id="buttonweight"></div>
    <div id="titleweight"></div>
    <div id="weight"></div>
</div>
