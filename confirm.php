<?php
session_start();
require('dbconnect.php');

// 手前のページで入力された数値を変数に格納
$email = $_SESSION['confirm']['email'];
$confirm_number = $_SESSION['confirm']['confirm_number'];

unset($_SESSION['confirm']);

// 予約情報の取得
$reserve_sql = 'SELECT `rs`.*,`rm`.*,`st`.* FROM `reservations` AS `rs` LEFT JOIN `rooms` AS `rm` ON `rs`.`room_id` = `rm`.`room_id` LEFT JOIN `studios` AS `st` ON `rm`.`studio_id` = `st`.`studio_id` WHERE `conf_email` = ? AND `confirm_number` = ? AND `date` >= CURDATE()';
$reserve_data = [$email, $confirm_number];
$stmt = $dbh->prepare($reserve_sql);
$stmt->execute($reserve_data);
while(true) {
  $reserve_rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($reserve_rec == false){
    break;
  }
  $reserves[] = $reserve_rec;
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
              ー予約一覧ー
            </h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2 class="mypage-h2">現在予約しているスタジオ</h2>
          <?php foreach($reserves as $reserve): ?>
            <div class="col-md-12 reserve-list">
              <h3><?= $reserve['studio_name'] . ' ' . $reserve['room_name']; ?></h3>
              <table class="table table-striped detail-info table-propotion">
                <caption>スタジオの予約情報</caption>
                  <tr>
                    <td>利用日時</td>
                    <td><?= $reserve['date'] . ' ' . substr($reserve['start_time'], 0, -3) . ' 〜 ' . substr($reserve['fin_time'], 0, -3); ?></td>
                  </tr>
                  <tr>
                    <td>利用人数</td>
                    <td><?= $reserve['number_of_people']; ?> 人</td>
                  </tr>
                  <tr>
                    <td>最寄駅</td>
                    <td><?= $reserve['station']; ?></td>
                  </tr>
                  <tr>
                    <td>電話番号</td>
                    <td><?= $reserve['studio_tel']; ?></td>
                  </tr>
                  <tr>
                    <td>住所</td>
                    <td><?= $reserve['address']; ?></td>
                  </tr>
              </table>
              <small>※予約時間の変更やキャンセルはスタジオに直接お問い合わせください</small>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require('footer.php'); ?>


</body>
</html>