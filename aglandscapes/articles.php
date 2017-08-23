<?php

      session_start();

      require('dbconnect.php');


    if (isset($_SESSION['login_member_id']) && ($_SESSION['time'] + 3600 > time())) {
      // 存在してたらログインしてる
      // 最終アクション時間を更新
      $_SESSION['time'] = time();


      $sql = 'SELECT * FROM `members` WHERE `member_id` ='.$_SESSION['login_member_id'];
      // ログインする際にはPOST送信で送信されているのでarray($POST())になるが
      // すでにログインしている人をSESSIONで情報を保存している
      // どこの画面からでも使えるSESSIONで使える
      // ログインしている情報をいろんなページで閲覧できるようにSESSIONで保存した方が使いやすい
      $stmt   = $dbh->prepare($sql);
      $stmt->execute();
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $name = $record['name'];

    }else{

      // ログインしていない
      header('Location: top.php');
      exit();
    }

    $sql = 'SELECT * FROM `members` WHERE `member_id`='.$_SESSION['login_member_id'];
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $member = array();
    while ($record = $stmt->fetch(PDO::FETCH_ASSOC)){
        $member[] = array("name"=>$record['name'],
                       "profile"=>$record['profile']);
      }


    $sql = 'SELECT * FROM `articles` WHERE `member_id`='.$_SESSION['login_member_id'];
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $card = array();

    while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {

          $card[] = array("article_id"=>$record['article_id'],
                           "member_id"=>$record['member_id'],
                               "title"=>$record['title'],
                       "prefecture_id"=>$record['prefecture_id'],
                               "place"=>$record['place'],
                              "access"=>$record['access'],
                               "start"=>$record['start'],
                              "finish"=>$record['finish'],
                          "product_id"=>$record['product_id'],
                                "work"=>$record['work'],
                          "treatment1"=>$record['treatment1'],
                          "treatment2"=>$record['treatment2'],
                          "treatment3"=>$record['treatment3'],
                          "treatment4"=>$record['treatment4'],
                          "treatment5"=>$record['treatment5'],
                          "treatment6"=>$record['treatment6'],
                          "landscapes"=>$record['landscapes'],
                             "comment"=>$record['comment'],
                              );

    }




?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AGLANDSCAPES</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/form.css" rel="stylesheet">
    <link href="assets/css/timeline.css" rel="stylesheet">
    <link href="assets/css/anly_main.css" rel="stylesheet">
    <link href="assets/css/anly_ag_original.css" rel="stylesheet">
    <link href="assets/css/risa_main.css" rel="stylesheet">
    <link href="assets/css/risa_ag_original.css" rel="stylesheet">
    <link href="assets/css/body.css" rel="stylesheet">

    <!--
      designフォルダ内では2つパスの位置を戻ってからcssにアクセスしていることに注意！
     -->
  </head>
<body>


<!-- ヘッダー -->
<?php include('header.php') ?>

<!--          header finish             -->

  <div class="container" style="padding-top: 60px;">
    <div class="row">
<!--         left column         -->
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="text-center">
          <?php foreach ($member as $record) {
                $name = $record['name'];
             $profile = $record['profile'];
          } ?>
          <?php if (empty($profile)){ ?>
          <img src="img/misteryman.jpg" style="width:160px;height:160px ">
          <?php }else{ ?>
          <img src="member_picture/<?php echo $profile; ?>" class="avatar img-thumbnail">
          <?php } ?>
          <div>
            <?php echo $name; ?>さん
          </div>
          <div>
            <button type="submit" class=" btn btn-primary col-xs-12" onClick="location.href='account.php'">アカウント情報の編集</button>
          </div>
          <br><br>
          <div>
            <button type="submit" class="btn btn-primary col-xs-12" onClick="location.href='add_post.php'">募集記事作成画面</button>
          </div>
          <br><br>
          <div>
            <button type="submit" class=" btn btn-primary col-xs-12" onClick="location.href='top.php'">トップページへ戻る</button>
          </div>
        </div>
      </div>
      <!-- edit form column -->
      <div class="col-md-10 col-sm-6 col-xs-12 personal-info">

        <div class="text-center">
          <div class="col-sm-8 col-sm-offset-1">
            <!-- 募集記事 -->
            <div class="post-header font-alt">
              <h1 class="post-title"></i>募集記事一覧</h1>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-sm-12" style="width: 790px;">
               <table class="table table-striped table-bordered checkout-table">
                  <tbody>
                  <?php foreach ($card as $record) {
                      $article = $record['article_id'];
                      $title = $record['title'];
                      $start = $record['start'];
                      $finish = $record['finish']; ?>
                    <tr>
                      <th class="hidden-xs" style="width: 126px">タイトル</th>
                      <th>期間</th>
                      <th>質問</th>
                    </tr>
                    <?php if(isset($card)){ ?>
                    <tr>
                      <td class="hidden-xs"><h5><?php echo $title; ?></h5></td>
                      <td><h5 class="product-title font-alt"><?php echo $start.'~'.$finish; ?></h5></td>
                      <td>
                      <button type="submit" class="btn btn-default" onClick="location.href='answer.php?article_id=<?php echo $article;?>'">質問ルームへ</button></td>
                    </tr>
                    <?php }else{
                      echo "まだ投稿した記事がありません";
                      } ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


    <!-- フッター -->
    <?php include('footer.php') ?>


       <!-- Scripts -->
      <script src="js/jquery.js"></script>
      <script src="js/functions.js"></script>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
