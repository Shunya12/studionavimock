<?php
session_start();
require('dbconnect.php');
$user_id = $_SESSION['id'];

// ログインしていない場合ログインページに遷移
if(!isset($_SESSION['id'])){
  header('Location: signin.php?from=mypage');
  exit();
}

// 予約情報の取得
$reserve_sql = 'SELECT `rs`.*,`rm`.*,`st`.* FROM `reservations` AS `rs` LEFT JOIN `rooms` AS `rm` ON `rs`.`room_id` = `rm`.`room_id` LEFT JOIN `studios` AS `st` ON `rm`.`studio_id` = `st`.`studio_id` WHERE `user_id` = ? AND `date` >= CURDATE()';
$reserve_data = [$user_id];
$stmt = $dbh->prepare($reserve_sql);
$stmt->execute($reserve_data);
while(true) {
  $reserve_rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if($reserve_rec == false){
    break;
  }
  $reserves[] = $reserve_rec;
}




// ユーザー情報の取得
$user_sql = 'SELECT `u` . `name`, `u`.`user_mail` FROM `users` AS `u` WHERE `user_id` = ?';
$user_data = [$user_id];
$stmt = $dbh->prepare($user_sql);
$stmt->execute($user_data);
$user_profile = $stmt->fetch(PDO::FETCH_ASSOC);


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
              ーマイページー
            </h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h2 class="mypage-h2">現在予約しているスタジオ</h2>
          <?php if(empty($reserves)): ?>
            <p>予約はありません</p>
          <?php else: ?>
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
                    <td>料金</td>
                      <td><?= $reserve['price']; ?> 円</td>
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
          <?php endif; ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 user-info">
          <h2 class="mypage-h2">登録者情報</h2>
          <table class="table table-striped table-propotion">
                <tr>
                  <td>名前</td>
                  <td><?= $user_profile['name']; ?></td>
                </tr>
                <tr>
                  <td>メールアドレス</td>
                  <td><?= $user_profile['user_mail']; ?></td>
                </tr>
            </table>
          <div class="centered"><a href="change.php" class="btn btn-info btn-lg change-btn">登録情報の変更</a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require('footer.php'); ?>


</body>
</html>