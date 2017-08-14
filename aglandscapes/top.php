
<?php
session_start();//SESSION変数を使う時に絶対必要


//ログインボタンが押された時
if (!empty($_POST)){
  //email,passwordどちらも値が入力されてた時

  if ($_POST['email'] !=''&& $_POST['password']!=''){

    //デーtベースに接続
    //外部ファイルから処理の読み込み
    require('dbconnect.php');
    // 今入力された情報の会員登録が存在しているかチェック
    //SELECT文で入力されたemail,passwordを条件にして一致するデータを取得
    $sql = 'SELECT * FROM `members` WHERE `email`= ?
    AND `password`=?';
    $data= array($_POST['email'],sha1($_POST['password']));
    //入力されたデータを指定（最初はemailだけ

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    //データ取得
    $record=$stmt->fetch(PDO::FETCH_ASSOC);
   // var_dump($reord);
     if ($record == false){
      //フェッチして、データが取得できない時は＄recordにfalseが代入される
      //ログイン失敗
      //存在してなかったら、ログイン失敗のマークを保存
      $error['login'] = 'failed';
    
  }else{
//ログイン成功
  //ログインしている人のmember_idをSESSIONに保存
  //現在の時刻を表す情報をSESSIONに保存（1時間を使用していない場合に自動でログアウトさせるため）
    $_SESSION['login_member_id']=$record['member_id'];
    //どの画面でも保存されているデータ

    $_SESSION['time']=time();
    //1970年1月1日０時0分０秒から現在までの秒数が保存される
    header('Location:top.php');
    exit();
  }

 }else{
   
    //存在していたら、index.phpへ移動、存在していなかったら、ログイン失敗のマークを保存
    $error ['login'] = 'blank';

  }
  }
?>



<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AGLANDSCAPES</title>

      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet" />
      <link href="img/favicon.png" type="image/x-icon" rel="shortcut icon" />
      <link href="assets/css/screen.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="css/assets/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="css/assets/css/bootstrap.css">

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/form.css" rel="stylesheet">
    <link href="assets/css/top_timeline.css" rel="stylesheet">
    <link href="assets/css/top_main.css" rel="stylesheet">
    <link href="assets/css/top_ag_original.css" rel="stylesheet">
    <!--
      designフォルダ内では2つパスの位置を戻ってからcssにアクセスしていることに注意！
     -->
  </head>
<body>


<!-- ヘッダー -->
      <?php include('header.php') ?>



  <div class="">

   <div class="content-box">
         <!-- Hero Section -->
         <section class="section section-hero">
            <div class="hero-box">
               <div class="container">
                  <div class="hero-text align-center">
                     <h1>AglandScapes</h1>
                      <p>農業に新たな活力を！　旅行に新たな感動を!</p>
                       <p>そして、その出会いは人生の新たな一歩へ!</p>
                  </div>

                    <!--Login Section-->
            <div class="container" align="center">
                        
                        <form method="POST" action="" class="form-signin mg-btm" name="login">
                           <div class="social-box">
                              <div class="row mg-btm">
                                  <div class="col-md-12">
                                     <a href="#" class="btn btn-primary">
                                       <i class="icon-facebook"></i>  Facebookアカウントでログイン
                                     </a>
                                  </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                     <a href="#" class="btn btn-info" >
                                       <i class="icon-twitter"></i>   Twitterアカウントでログイン
                                     </a>
                                 </div>
                               </div>
                                  <?php if(isset($error['login']) && ($error['login']=='blank')) {?>
              <!--issetこの変数は存在していた時-->
              <h4 class="error">*メールアドレスとパスワードをご記入ください。</h4>
               <!--$error[login']がfailedの時、class="error"のレイアウトを使用して、「＊ログインに失敗しました。再度正しい情報でログインしてください。」
               と表示しましょう。jion/index.phpを参考に-->

              <?php }?>
               <?php if(isset($error['login']) && ($error['login']=='failed')) {?>
              <!--issetこの変数は存在していた時-->
              <h4 class="error">*ログインに失敗しました。再度正しい情報でログインしてください。</h4>
              <?php }?>
                            <div class="main">   
        
                               <input name="email" type="text" class="form-control" placeholder="メールアドレス" autofocus>
                               <input name="password" type="password" class="form-control" placeholder="パスワード">
                              <a href="javascript:void(0)" onclick="document.login.submit();return false;" type="submit" class="btn btn-large btn-danger pull-right">ログイン</a>
                           　</div>
                              <div class="main">   
                             <h5 style="color:#FFFFFF">アカウントをお持ちではない場合</h5>
                             <a type="button" href="join/index.php" class="btn btn-danger pull-right">新規登録</a>
                              </div>
                           </div>
                        </form>

                         <section class="">
                         <div class="section section-hero" style="color: #FFFFFF">
                        
                             <h3>AGLANDSCAPESとは </h3>
                              <h3 class="text-left">農家さんと農業に関心がある、学びたいと思っている方（体験者）をつなぐ役割</h3>
                              <h3 class="text-left">を担うのがAglandscapes。Agri(農業）＋landscapes(風景）で、農業のある風景</h3>
                              <h3 class="text-left">を将来に残したい。そんな思いから出来上がったサービスです。   </h3>
                              
                         </div>
                        </div>
                    </div>       
              </div>

            <!-- Statistics Box -->

            
            <div class="container">
               <div class="statistics-box">
                  <div class="statistics-item">
                     <a href="genre_search.php" class="value">都道府県</a>
                  </div>

                  <div class="statistics-item">
                     <a href="genre_search.php" class="value">期間</a>
                  </div>

                 <div class="statistics-item">
                     <a href="genre_search.php" class="value">作物</a>
                  </div>
                  
               </div>
            </div>
            
            <br>
            <br>

         

         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title">新着募集</h2>
               </div>


            <!-- card section-->
        
      <div class="container">
         <div class="row">

          <hr>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>



           </div>
       </div>


            <div class="row row-margin-bottom">

                 <div class="align-center">
                  <a href="#" class="btn btn-default btn-load-destination"><span class="text">新着募集をもっと見る</span><i class="icon-spinner6"></i></a>
               </div>
            </div>


         <!-- Parallax Box --> 
      <div class="container">
         <div class="parallax-box">
               <div class="text align-center">
                  <h1>おすすめ</h1>
               </div>
         </div>

       <div class="container">
         <div class="row">

          <hr>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>
      <?php include('card.php') ?>

          </div>
       </div>
 

               <div class="align-center">
                  <a href="#" class="btn btn-default btn-load-boats"><span class="text">おすすめをもっと見る</span><i class="icon-spinner6"></i></a>
               </div>
            </div>
         </section>
      </div>
   <!-- フッター -->
      <?php include('footer.php') ?>

   <!-- Scripts -->
      <script src="js/jquery.js"></script>
      <script src="js/functions.js"></script>
   </body>
</html>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="../assets/js/jquery-3.1.1.js"></script> -->
    <!-- <script src="../assets/js/jquery-migrate-1.4.1.js"></script> -->
    <!-- <script src="../assets/js/bootstrap.js"></script> -->
  <!-- </body> -->
<!-- </html> -->
