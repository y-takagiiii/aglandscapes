<?php
    session_start();
    require('dbconnect.php');
    $sql = 'SELECT * FROM `articles` WHERE `article_id=?`';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>カード詳細</title>
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/form.css" rel="stylesheet">
  <link href="assets/css/timeline.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="assets/css/card.css"> -->
  <link rel="stylesheet" href="assets/css/card_main.css">
  <link rel="stylesheet" href="assets/css/card_ag_original.css">
</head>
<body>
  <div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <?php $title="10/1~2 ぶどう収穫募集！"; ?>
    <?php $prefecture="北海道"; ?>
    <?php $place="札幌市◯◯町"; ?>
    <?php $access="札幌駅から◯◯線に乗り、☓☓駅で下車後、徒歩15分"; ?>
    <?php $start="2017年9月10日"; ?>
    <?php $finish="2017年9月30日"; ?>
    <?php $product="じゃがいも"; ?>
    <?php $work="収穫"; ?>
    <?php $treatment1 = 0?>
    <?php $treatment2 = 0?>
    <?php $treatment3 = 0?>
    <?php $treatment4 = 0?>
    <?php $treatment5 = 0?>
    <?php $treatment6 = 1?>
    <?php $landscape='img/g.jpg' ?>
    <?php $comment='絶景広がる牧場で働く
おだやかな家族、のどかな環境のもと、牛たちとともにあなたらしく生きませんか？
◇規模拡大に向け、複数名募集◇'?>
    <?php $favorite_flag = 1 ?>
    <?php $login_member_id =1 ?>
    <?php $article_id = 1 ?>
    <?php $apply_id= 1 ?>




    <?php include('card.php'); ?>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12"></div>
  </div>
</body>
</html>