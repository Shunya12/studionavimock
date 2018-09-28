<?php
session_start();
require('dbconnect.php');


// セッションの値を変数に格納
if(isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  $user_id = 0;
}
$studio_name = $_SESSION['reserve']['studio_name'];
$room_name = $_SESSION['reserve']['room_name'];
$date = $_SESSION['reserve']['date'];
$start_time = $_SESSION['reserve']['start_time'];
$fin_time = $_SESSION['reserve']['fin_time'];
$users = $_SESSION['reserve']['users'];
$user_name = $_SESSION['reserve']['user_name'];
$user_email = $_SESSION['reserve']['user_email'];
$studio_mail = $_SESSION['reserve']['studio_mail'];
$use_style = $_SESSION['reserve']['use_style'];
$price_per_hour = $_SESSION['reserve']['price_per_hour'];
$night_price = $_SESSION['reserve']['night_price'];
$room_id = $_SESSION['reserve']['room_id'];
$room_img = $_SESSION['reserve']['room_img'];
$no_img = 'no_image.jpg';


// 利用時間を生成
$st_time = strtotime("$date $start_time");
$fn_time = strtotime("$date $fin_time");
$use_time = ($fn_time - $st_time) / 3600;

// 料金を計算(デイユースなら料金を計算、深夜なら深夜料金をそのまま代入)
if($use_style == 'day_use'){
  $price = intval($price_per_hour * $use_time);
} else {
  $price = $night_price;
}



// 予約番号を生成｜データベースにアクセスして未来の予約に入っている数値を除いて数値を作り出して配列に詰め込む｜配列の中身にconfirm_numberが含まれていたら繰り返す。被ってなかったら終了
$number_check = [];
$confirm_number = mt_rand(1000, 9999);
$check_sql = 'SELECT `reservations`.`confirm_number`, `reservations`.`date` FROM `reservations` WHERE `date` <= DATE(NOW())';
$check_stmt = $dbh->prepare($check_sql);
$check_stmt->execute();

while(1) {
  $rec = $check_stmt->fetch(PDO::FETCH_ASSOC);
  if($rec == false) {
    break;
  }
  $number_check[] = $rec;
}

while(in_array($confirm_number, $number_check)) {
  $confirm_number = mt_rand(1000, 9999);
}


// 予約情報を送信
if(!empty($_POST)) {
  $sql = 'INSERT INTO `reservations` SET `room_id` = ?, `number_of_people` = ?, `use_style` = ?, `date` = ?, `start_time` = ?, `fin_time` = ?, `user_id` = ?, `conf_email` = ?, `confirm_number` = ?, `price`= ?, `created` = NOW()';
  $data = [$room_id, $users, $use_style, $date, $start_time, $fin_time, $user_id, $user_email, $confirm_number, $price];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $_SESSION['reserve']['confirm_number'] = $confirm_number;
  header('Location: thanks.php');
  exit();
}


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
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
      <div class="row">
        <div class="col-md-12">
          <div class="form-title">
            <h1>
              ー予約情報確認ー
            </h1>
            <p>
              以下のスタジオを予約します
            </p>
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <img src="img/<?= $room_img == '' ? $no_img : $room_img; ?>" class="studio-img">
        </div>
        <div class="col-md-8 col-xs-12">
          <h1><?= htmlspecialchars($studio_name); ?></h1>
          <h2><?= htmlspecialchars($room_name); ?></h2>
        </div>
        <div class="col-md-12">
          <table class="table table-striped detail-info">
            <caption>ご利用情報</caption>
              <tr>
                <td>ご利用時間</td>
                <?php if($use_style == 'day_use'): ?>
                  <td><?= htmlspecialchars($date .' / '. $start_time . ' 〜 ' . $fin_time); ?></td>
                <?php else: ?>
                  <td><?= htmlspecialchars($date .' / 深夜に利用（翌朝まで）'); ?></td>
                <?php endif; ?>
              </tr>
              <tr>
                <td>利用人数</td>
                <td><?= htmlspecialchars($users); ?></td>
              </tr>
              <tr>
                <td>料金</td>
                <?php if($use_style == 'day_use'): ?>
                  <td><?= htmlspecialchars($price); ?> 円</td>
                <?php else: ?>
                  <td><?= htmlspecialchars($night_price); ?> 円</td>
                <?php endif; ?>
              </tr>
              <tr>
                <td>利用者</td>
                <td><?= htmlspecialchars($user_name); ?></td>
              </tr>
              <tr>
                <td>返信先のメールアドレス</td>
                <td><?= htmlspecialchars($user_email); ?></td>
              </tr>
          </table>
        </div>
        <div class="col-md-12 check-go">
          <form method="POST" action="">
            <a href="reserve.php?action=rewrite" class="btn btn-secondary btn-lg">戻る</a>
            <input type="hidden" name="action" value="submit">
            <input type="submit" value="予約する" class="btn btn-lg submit-color">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  <?php require('footer.php'); ?>


</body>
</html>