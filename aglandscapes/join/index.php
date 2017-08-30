<?php
    session_start();//SESSION変数を使うとき必ず指定 $errorという変数を用意して入力チェック、引っかかった項目の情報を保存する
// $errorはhtmlの表示の部分で入力を促す表示を作るときに使用
// 例）もしnick_nameに何も入っていなかったら $error['nick_name']='blank';という情報を保存

// フォームからデータが送信されたとき
if(!empty($_POST)){
  // エラー項目の確認
    if($_POST['name']=='管理者'){
      $error['name']='admin';
    }
    // 氏名が未入力
    if($_POST['name']==''){
      $error['name']='blank';
    }
    if($_POST['email']=='al.admin@gmail.com'){
      $error['email']='admin';
    }
  // メールアドレスが未入力
      if($_POST['email']==''){
      $error['email']='blank';
    }
  // パスワードが未入力
      if($_POST['password']==''){
      $error['password']='blank';
    }else{
      // パスワード文字長チェック
      // ここのチェックした結果を使ってHTMLに「パスワードは４文字以上を入力してください」というメッセージを表示してください
      if(strlen($_POST['password']) < 4){
        $error['password'] = 'length';
      }
    }

      // パスワード確認が未入力
      if($_POST['password_re']==''){
      $error['password_re']='blank';
      }

      //パスワードとパスワード確認が一致していない
      if($_POST['password_re']!==$_POST['password']){
        $error['password_re']='diffarent';
      }

      $_SESSION['join']=$_POST;

      $_SESSION['join']['birthday']=$_SESSION['join']['year']."/".$_SESSION['join']['month']."/".$_SESSION['join']['day'];



    // エラーがない場合
    if(empty($error)){

    // check.phpへ移動する
    header('Location: check.php');
    exit();//ここでphpの処理が終わる
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

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/form.css" rel="stylesheet">
    <link href="../assets/css/timeline.css" rel="stylesheet">
    <link href="../assets/css/kaz_main.css" rel="stylesheet">
    <link href="../assets/css/kaz_ag.original.css" rel="stylesheet">
    <!--
      designフォルダ内では2つパスの位置を戻ってからcssにアクセスしていることに注意！
     -->

  </head>


  <body>
  <!-- ヘッダー -->
    <?php include('../header.php') ?>



  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 content-margin-top">
        <legend>会員登録</legend>
        <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
        <p><center><u><a href="#">Facebook</a></u> あるいは <u><a href="#">Twitter</a></u> でログインする。</center></p>
        <center>or</center><br>


          <!-- ニックネーム -->
          <div class="form-group">
            <label class="col-sm-4 control-label">氏名</label>
            <div class="col-sm-8">

            <!--ユーザーがニックネームを入力して確認へボタンを確認した後だったら -->
            <?php if (isset($_POST['name']))  { ?>
              <input type="text" name="name" class="form-control" placeholder="例： Seed kun" value="<?php echo htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'); ?>"><br>
            <?php }elseif (isset($_SESSION['join']['name'])) { ?>
              <input type="text" name="name" class="form-control" placeholder="例： Seed kun" value="<?php echo htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'); ?>"><br>
            
            <?php }else{ ?>
              <input type="text" name="name" class="form-control" placeholder="例： Seed kun"><br>
            <?php } ?>
            <?php if (isset($error['name']) &&($error['name']=='blank')) { ?>
                <h6 style="color: red">*名前を入力してください。</h6>
            <?php } ?>
           <?php if (isset($error['name']) &&($error['name']=='admin')) { ?>
                <h6 style="color: red">*その名前は使用できません。</h6>
            <?php } ?>

            </div>
          </div>


          <!-- メールアドレス -->
          <div class="form-group">
            <label class="col-sm-4 control-label">メールアドレス</label>
            <div class="col-sm-8">
            <!--ユーザーがニックネームを入力して確認へボタンを確認した後だったら -->
            <?php if (isset($_POST['name'])) { ?>
              <input type="email" name="email" class="form-control" placeholder="例： seed@nex.com" value="<?php echo htmlspecialchars($_POST['name'],ENT_QUOTES, 'UTF-8'); ?>"><br>
            <?php }else{ ?>
              <input type="email" name="email" class="form-control" placeholder="例： seed@nex.com"><br>
            <?php } ?>
            <?php if (isset($error['email']) &&($error['email']=='blank')) { ?>
                <h6 style="color: red">*メールアドレスを入力してください。</h6>
            <?php } ?>
            <?php if (isset($error['email']) &&($error['email']=='admin')) { ?>
                <h6 style="color: red">*そのメールアドレスは使用できません。</h6>
            <?php } ?>

            </div>
          </div>
          <!-- パスワード -->
          <div class="form-group">
            <label class="col-sm-4 control-label">パスワード</label>
            <div class="col-sm-8">
            <?php if(isset($_POST['password'])){ ?>
              <input type="password" name="password" class="form-control" placeholder="例： 4文字以上入力" value="<?php echo htmlspecialchars($_POST['password'],ENT_QUOTES, 'UTF-8'); ?>"><br>
              <?php }else{ ?>
              <input type="password" name="password" class="form-control" placeholder="例： 4文字以上入力"><br>
              <?php } ?>
              <?php if (isset($error['password']) &&($error['password']=='blank')) { ?>
                <h6 style="color: red">*パスワードを入力してください。</h6>
                <?php } ?>
              <?php if (isset($error['password']) &&($error['password']=='length')) { ?>
                <h6 style="color: red">*パスワードは４文字以上を入力してください。</h6>
                <?php } ?>
            </div>
          </div>
          <!-- パスワード確認用 -->
          <div class="form-group">
            <label class="col-sm-4 control-label">パスワード確認</label>
            <div class="col-sm-8">
            <?php if(isset($_POST['password_re'])){ ?>
              <input type="password" name="password_re" class="form-control" placeholder="例： 4文字以上入力" value="<?php echo htmlspecialchars($_POST['password_re'],ENT_QUOTES, 'UTF-8'); ?>"><br>
              <?php }else{ ?>
              <input type="password" name="password_re" class="form-control" placeholder="例： 4文字以上入力"><br>
              <?php } ?>
              <?php if (isset($error['password_re']) &&($error['password_re']=='blank')) { ?>
                <h6 style="color: red">*パスワード確認を入力してください。</h6>
                <?php } ?>
              <?php if (isset($error['password_re']) && ($error['password_re']=='diffarent')) { ?>
                <h6 style="color: red">*パスワードと異なります。</h6>
                <?php } ?>

            </div>
          </div>

          <!-- 住所 -->
          <div class="form-group">
            <label class="col-sm-4 control-label">住所（任意）<br>*体験応募時は必須</label>
            <div class="col-sm-8">
            <?php if(isset($_POST['address'])){ ?>
              <input type="text" name="address" class="form-control" placeholder="例： 東京都八王子市〇〇ー〇" value="<?php echo htmlspecialchars($_POST['address'],ENT_QUOTES, 'UTF-8'); ?>">
              <?php }else{ ?>
              <input type="text" name="address" class="form-control" placeholder="例： 東京都八王子市〇〇ー〇">
              <?php } ?>
            </div>
          </div>

          <!-- 電話番号 -->
          <div class="form-group">
            <label class="col-sm-4 control-label">電話番号（任意）<br>*体験応募時は必須</label>
            <div class="col-sm-8">
            <?php if(isset($_POST['phone_number'])){ ?>
              <input type="text" name="phone_number" class="form-control" placeholder="例： 090-〇〇〇〇-〇〇〇〇" value="<?php echo htmlspecialchars($_POST['phone_number'],ENT_QUOTES, 'UTF-8'); ?>">
              <?php }else{ ?>
              <input type="text" name="phone_number" class="form-control" placeholder="例： 090-〇〇〇〇-〇〇〇〇">
              <?php } ?>
            </div>
          </div>


            <div class="form-group">
              <label class="col-sm-4 control-label">生年月日（任意）</label>&nbsp;

              <form name="yyyymmdd" method="post" action="#">
                <select name="year">
                <option value="">--</option>
                                <?php $i=2000;
                for($i=2000;$i>=1920;$i--){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>

                </select>
                年 
                <SELECT name="month">
                <option value="">--</option>
                <?php $i=1;
                for($i=1;$i<=12;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
                </SELECT>
                月 
                <SELECT name="day">
                <option value="">--</option>
                <?php $i=1;
                for($i=1;$i<=31;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
                </select>
                日 
                </center></p><br>
              <center><h6>会員登録するためには18歳以上でなくてはなりません。</h6></center>

          </div>
      <div class="col-md-8 col-md-offset-2">
      <div style="border:thin solid gray;width:350;height:200;overflow:auto;
              scrollbar-3dlight-color:gray;
              scrollbar-arrow-color:gray;
              scrollbar-darkshadow-color:gray;
              scrollbar-face-color:gray;
              scrollbar-highlight-color:gray;
              scrollbar-shadow-color:gray;
              scrollbar-track-color:gray;
              overflow-y: scroll;
              height: 150px;">
              <Table border="0" width="300" height="300" cellspacing="0" bgcolor="#ffffff">
              <Tr><Td align="center" valign="top">
              規約内容
              </Td></Tr>
              </Table></div><br>
          <div>
              <center><input type="checkbox" name="agree_privacy" id="agree" value="" required="required">
              <label for="agree">規約に同意する。</label></center>
          </div><br>
            </div>

          <center><input type="submit" class="btn btn-default" value="確認画面へ"></center><br><br><br><br><br>
        </form>
      </div>
    </div>
  </div>
  </div>


<!-- フッター -->
    <?php include('../footer.php') ?>





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/js/jquery-3.1.1.js"></script>
    <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
  </body>
</html>