<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\CustomAppAsset;
use common\widgets\Alert;

CustomAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Start Header Area -->
  <header class="default-header">
    <div class="container">
      <div class="header-wrap">
        <div class="header-top d-flex justify-content-between align-items-center">
          <div class="logo">
            <a href="#home"><img src="http://localhost/jualikan.id/img/logo.png" alt=""></a>
          </div>
            <div class="main-menubar d-flex align-items-center">
            <nav>
              <a href="http://localhost/jualikan.id/site/index/#home">Home</a>
              <a href="http://localhost/jualikan.id/site/index/#service">Services</a>
              <a href="http://localhost/jualikan.id/site/login">Login</a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End Header Area -->

    <div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>



<footer>
  <div class="container">
    <p>&copy; Your Website 2018. All Rights Reserved.</p>
    <ul class="list-inline">
      <li class="list-inline-item">
        <a href="#">Privacy</a>
      </li>
      <li class="list-inline-item">
        <a href="#">Terms</a>
      </li>
      <li class="list-inline-item">
        <a href="#">FAQ</a>
      </li>
    </ul>
  </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
