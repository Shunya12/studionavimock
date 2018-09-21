<?php
session_start();


// 予約番号の表示用
$confirm_number = $_SESSION['reserve']['confirm_number'];




?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta discription="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <?php require('header.php'); ?>

  <div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ーTHANKS!!ー
          </h1>
          <p>
            スタジオに問い合わせ中です</br>入力したメールアドレスに返信が来るまでお待ちください
          </p>
          <div class="line-share">
            <div class="text-center">
              <h2>予約番号</h2>
              <p class="cf-num"><?= $confirm_number ?></p>
            </div>
            <p><i class="fab fa-line fa-6x"></i></p>
            <p>スタジオ情報をLINEで共有する</p>
          </div>
          <p>- <a class="body-link" href="top.php">TOPに戻る</a> -</p>
        </div>
      </div>
    </div>
  </div>
</div>

  <?php require('footer.php'); ?>

</body>
</html>