<?php
// 待遇に内容書き込み
    if($treatment1 == 1){
      $treatment_text1 = '朝食あり';
    }else{
      $treatment_text1 = '';
    }

    if($treatment2 == 1){
      $treatment_text2 = '昼食あり';
    }else{
      $treatment_text2 = '';
    }

    if($treatment3 == 1){
      $treatment_text3 = '夕食あり';
    }else{
      $treatment_text3 = '';
    }

    if($treatment4 == 1){
      $treatment_text4 = '送迎あり';
    }else{
      $treatment_text4 ='';
    }

    if($treatment5 == 1){
      $treatment_text5 = '道具貸与';
    }else{
      $treatment_text5 ='';
    }

    if($treatment6 == 1){
      $treatment_text6 = '個室あり';
    }else{
      $treatment_text6 ='';
    }


?>

<div class="row row-margin-bottom">
  <div class="lib-panel">
  <div class="row box-shadow">
        <div class="row1 col-md-12 col-sm-12 col-xs-12">
      <!-- 写真部分 -->
          <div class="col-md-6 col-sm-12 col-xs-12" id="card-picture">
            <img src="post_picture/<?php echo $landscape ?>" style="width:100%;height:100%;">
          </div>
        <!-- 詳細部分 -->
          <div class="col-md-6 col-sm-12 col-xs-12" id="detail">
            <div class="lib-row lib-header">
                  <h1><?php echo $title; ?></h1>
                  <div class="lib-header-seperator"></div>
            </div>
            <div class="lib-row lib-desc">
              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">地域</label>
                <p class="col-sm-8 no-padding"><?php echo $prefecture ?></p>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">場所</label>
                  <p class="col-sm-8 no-padding"><?php echo $place ?></p>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">アクセス</label>
                <p class="col-sm-8 no-padding"><?php echo $access ?></p>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">期間</label>
                <p class="col-sm-8 no-padding"><?php echo $start ?><?php echo $finish ?></p>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">作物</label>
                <p class="col-sm-8 no-padding"><?php echo $product ?></p>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">作業</label>
                <p class="col-sm-8 no-padding"><?php echo $work ?></p>
              </div>

            <?php if(isset($treatment_text1) || isset($treatment_text2) || isset($treatment_text3) || isset($treatment_text4) || isset($treatment_text5) || isset($treatment_text6)){ ?>
              <div class="form-group">
                <label class="col-sm-4 control-label no-padding">待遇</label>
                <p class="col-sm-8 no-padding">
                  <?php if($treatment1 == 1){ ?>
                  <?php echo $treatment_text1 ?><br>
                  <?php } ?>
                  <?php if($treatment2 == 1){ ?>
                  <?php echo $treatment_text2 ?><br>
                  <?php } ?>
                  <?php if($treatment3 == 1){ ?>
                  <?php echo $treatment_text3 ?><br>
                  <?php } ?>
                  <?php if($treatment4 == 1){ ?>
                  <?php echo $treatment_text4 ?><br>
                  <?php } ?>
                  <?php if($treatment5 == 1){ ?>
                  <?php echo $treatment_text5 ?><br>
                  <?php } ?>
                  <?php if($treatment6 == 1){ ?>
                  <?php echo $treatment_text6 ?><br>
                  <?php } ?>
                </p>
              </div>
            <?php } ?>

            </div>
          </div>
      <!-- コメント部分 -->
        <div class="row2 col-md-12 col-sm-12 col-xs-12" id="comment">
          <p style="padding-top:20px; font-size:25px;"><?php echo $comment ?></p>
        </div>
      <!-- 質問・応募・お気に入りボタン -->
        <div class="row3 col-md-12 col-sm-12 col-xs-12 id" id="button">
          <center>
            <a href="chat.php?article_id=<?php echo $article_id ?>"><button type="button" class="btn btn-primary btn-lg btn3d"><span class="glyphicon glyphicon-question-sign"></span> 質問する</button></a>
            <?php if(empty($apply_id)){ ?>
            <a href="subscription.php?article_id=<?php echo $article_id ?>"><button type="button" class="btn btn-warning btn-lg btn3d"><span class="glyphicon glyphicon-ok"></span> 応募する</button></a>
            <?php }else{ ?>
            <button type="button" class="btn btn-warning btn-lg btn3d disabled"><span class="glyphicon glyphicon-ok"></span> 応募する</button>
            <?php } ?>
            <?php if($favorite_flag == 0){ ?>
            <a href="favorite.php?article_id=<?php echo $article_id ; ?>"><button type="button" class="btn btn-danger btn-lg btn3d"><span class="glyphicon glyphicon-heart"></span> お気に入り</button></a>
            <?php }else{ ?>
            <button type="button" class="btn btn-danger btn-lg btn3d disabled"><span class="glyphicon glyphicon-heart"></span> お気に入り</button>
            <?php } ?>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
