<?php
session_start();
require('dbconnect.php');


// 検索から来た場合はセッションにデータを保存
if(isset($_GET['std'])) {
  $studio_id = $_GET['std'];
  $room_id = $_GET['rm'];
  $_SESSION['std'] = $studio_id;
  $_SESSION['rm'] = $room_id;
// 詳細ページでログインを行なった場合はセッションからスタジオ情報を取得
} else if(isset($_GET['from']) && $_GET['from'] == 'login') {
  $studio_id = $_SESSION['std'];
  $room_id = $_SESSION['rm'];
}



// パラメータの数値をもとにスタジオの情報を取得する
$sql = 'SELECT `rooms`.*, `studios`.* FROM `rooms` LEFT JOIN `studios` ON `rooms`.`studio_id` = `studios`.`studio_id` WHERE `studios`.`studio_id` = ? AND `room_id` = ?';
$data = [$studio_id, $room_id];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$studio_rec = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['reserve']['studio_name'] = $studio_rec['studio_name'];
$_SESSION['reserve']['room_name'] = $studio_rec['room_name'];
$_SESSION['reserve']['studio_mail'] = $studio_rec['studio_mail'];
$_SESSION['reserve']['price_per_hour'] = $studio_rec['price_per_hour'];
$_SESSION['reserve']['night_price'] = $studio_rec['night_price'];
$_SESSION['reserve']['room_id'] = $_GET['rm'];

// ハイフンなしの電話番号を作成（リンク用）
$call = str_replace('-', '', $studio_rec['studio_tel']);
// 予約タイプを変数に格納
$rsv_type = $studio_rec['reserve_type'];

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
<?php
  include('header.php');
?>

  <div class="container main-body detail-box">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <img src="img/IMG_2105.jpg" class="studio-img">
      </div>
      <div class="col-md-8 col-xs-12">
        <h1><?= $studio_rec['studio_name']; ?></h1>
        <h2><?= $studio_rec['room_name']; ?></h2>
      </div>
      <div class="col-md-12">
        <table class="table table-striped detail-info">
          <caption>スタジオの詳細情報</caption>
            <tr>
              <td>スタジオの広さ</td>
              <td><?= $studio_rec['long_wide']; ?></td>
            </tr>
            <tr>
              <td>目安人数</td>
              <td><?= $studio_rec['capacity'] . '人'; ?></td>
            </tr>
            <tr>
              <td>最寄駅</td>
              <td><?= $studio_rec['station']; ?></td>
            </tr>
            <tr>
              <td>電話番号</td>
              <td>
                <a href="tel:<?= $call; ?>" class="body-link">
                  <?= $studio_rec['studio_tel']; ?>
                </a>
              </td>
            </tr>
            <tr>
              <td>住所</td>
              <td><?= $studio_rec['address']; ?></td>
            </tr>
        </table>
      </div>
      <div class="col-md-12">
        <iframe src="https://maps.google.co.jp/maps?output=embed&q=<?= $studio_rec['lat'] .','. $studio_rec['lng']; ?>" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div>


    <div class="row">
      <!-- 予約方法によって表示するボタンを切り替える -->
      <?php if($rsv_type == 'tmn' || $rsv_type == 'tm'): ?>
        <div class="d-block d-md-none col-sm-12 col-6">
          <div class="reserve-action">
            <a href="tel:<?= $call; ?>"><i class="fas fa-phone"></i> 電話をする</a>
          </div>
        </div>
        <div class="col-sm-12 col-6">
          <div class="reserve-action">
            <a href="reserve.php"><i class="far fa-calendar-alt"></i> 予約する</a>
          </div>
        </div>
      <?php elseif($rsv_type == 'tn'): ?>
        <div class="d-block d-md-none col-sm-12 col-6">
          <div class="reserve-action">
            <a href="tel:<?= $call; ?>"><i class="fas fa-phone"></i> 電話をする</a>
          </div>
        </div>
        <div class="col-sm-12 col-6">
          <div class="reserve-action">
            <a href="<?= $studio_rec['url']; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> 公式サイトで予約</a>
          </div>
        </div>
      <?php elseif($rsv_type == 'mn'): ?>
        <div class="col-6">
          <div class="reserve-action">
            <a href="reserve.php"><i class="far fa-calendar-alt"></i> 予約する</a>
          </div>
        </div>
        <div class="col-6">
          <div class="reserve-action">
            <a href="<?= $studio_rec['url']; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> 公式サイトで予約</a>
          </div>
        </div>
      <?php elseif($rsv_type == 't'): ?>
        <div class="d-block d-md-none col-12">
          <div class="reserve-action">
            <a href="tel:<?= $call; ?>"><i class="fas fa-phone"></i> 電話をする</a>
          </div>
        </div>
      <?php elseif($rsv_type == 'm'): ?>
        <div class="col-12">
          <div class="reserve-action">
            <a href="reserve.php"><i class="far fa-calendar-alt"></i> 予約する</a>
          </div>
        </div>
      <?php elseif($rsv_type == 'n'): ?>
        <div class="col-12">
          <div class="reserve-action">
            <a href="<?= $studio_rec['url']; ?>" target="_blank"><i class="fas fa-external-link-alt"></i> 公式サイトで予約</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

<?php
  include('footer.php');
?>

</body>
</html>