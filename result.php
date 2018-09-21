<?php
  session_start();
  require('dbconnect.php');


// このページでログインログアウトが行われた場合の処理
  if(isset($_GET['number_of_users'])) {
    $number_of_users = (int)$_GET['number_of_users'];
    $price = (int)$_GET['price'];
    $area = $_GET['area'];
    $_SESSION['number_of_users'] = $number_of_users;
    $_SESSION['price'] = $price;
    $_SESSION['area'] = $area;
  // 検索結果ページでログインを行なった場合はセッションからスタジオ情報を取得
  } else if(isset($_GET['from']) && $_GET['from'] == 'login') {
    $number_of_users = $_SESSION['number_of_users'];
    $price = $_SESSION['price'];
    $area = $_SESSION['area'];
  }

// GET送信されたらデータベースに接続してスタジオ情報を取得する
  if(!empty($_GET)) {
    $sql = '';
    $data = [];
    $sql1 = 'SELECT `rooms`.*, `studios`.*, `areas`.* FROM `rooms` LEFT JOIN `studios` ON `rooms`.`studio_id` = `studios`.`studio_id` LEFT JOIN `areas` ON `studios`.`area_id` = `areas`.`area_id` ';
    if($number_of_users != '' && $price != '指定しない' && $area != '指定しない') { // もし全部入力されていたら
        $sql2 = 'WHERE `capacity` >= ? AND `areas`.`area_id` = ?';
        if($price <= 5000) {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` < ? AND `price_per_hour` > ? - 999';
          $data = array($number_of_users, $area, $price, $price);
        } else {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` > ?';
          $data = array($number_of_users, $area, $price);
        }
    } else if($number_of_users != '' && $price != '指定しない' && $area == '指定しない') { // もし人数と値段だけ入力されていたら
        $sql2 = 'WHERE `capacity` >= ?';
        if($price <= 5000) {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` < ? AND `price_per_hour` > ? - 999';
          $data = array($number_of_users, $price, $price);
        } else {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` > ?';
          $data = array($number_of_users, $price);
        }
    } else if($number_of_users != '' && $price == '指定しない' && $area != '指定しない') { // もし人数とエリアだけ入力されていたら
        $sql2 = 'WHERE `capacity` >= ? AND `areas`.`area_id` = ?';
        $sql = $sql1 . $sql2;
        $data = array($number_of_users, $area);
    } else if ($number_of_users == '' && $price != '指定しない' && $area != '指定しない') { // もし値段とエリアだけ入力されていたら
        $sql2 = 'WHERE `areas`.`area_id` = ?';
        if($price <= 5000) {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` < ? AND `price_per_hour` > ? - 999';
          $data = array($area, $price, $price);
        } else {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` > ?';
          $data = array($area, $price);
        }
    } else if($number_of_users != '' && $price == '指定しない' && $area == '指定しない') { // もし人数だけ入力されていたら
        $sql2 = 'WHERE `capacity` >= ?';
        if($price <= 5000) {
          $sql = $sql1 . $sql2;
          $data = array($number_of_users);
        } else {
          $sql = $sql1 . $sql2 . ' AND `price_per_hour` > ?';
          $data = array($number_of_users, $area, $price);
        }
    } else if($number_of_users == '' && $price != '指定しない' && $area == '指定しない') { // もし値段だけ入力されていたら
        $sql2 = 'WHERE';
        if($price <= 5000) {
          $sql = $sql1 . $sql2 . ' `price_per_hour` < ? AND `price_per_hour` > ? - 999';
          $data = array($price, $price);
        } else {
          $sql = $sql1 . $sql2 . ' `price_per_hour` > ?';
          $data = array($price);
        }
    } else if($number_of_users == '' && $price == '指定しない' && $area != '指定しない') { // もしエリアだけ入力されていたら
        $sql2 = 'WHERE `areas`.`area_id` = ?';
        $sql = $sql1 . $sql2;
        $data = array($area);
    } else {
        $sql = $sql1;
    }

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

// 本文中の分はrowに対して３つのカードを表示する（カードが３件表示されるたびに新たなrowを挿入する）
      $cards = [];
      $i = 0;

      while(1) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rec == false) {
          break;
        }
        $cards[] =  $rec;
      }
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
  <?php
    include('header.php');
   ?>

 <section class="main-body">
    <?php foreach($cards as $card): ?>
        <?php $counter = $i; ?>
        <?php if($counter % 3 == 0): ?>
          <?= '<div class="card-deck">' ?>
        <?php endif; ?>
            <a href="detail.php?std=<?= $card['studio_id'] . '&rm=' . $card['room_id']; ?>" class="card result-a">
              <img class="card-img-top" src="img/IMG_2105.jpg">
              <div class="card-body">
                <h5 class="card-title"><?= $card['studio_name'] . ' ' . $card['room_name']; ?></h5>
                <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
              </div>
              <div class="card-footer">
                <small class="text-muted">このスタジオの詳細を見る</small>
              </div>
            </a>
        <?php if($counter % 3 == 2): ?>
          <?= '</div>' ?>
        <?php endif; ?>
        <?php $i++; ?>
    <?php endforeach; ?>
  </section>

   <?php
    include('footer.php');
   ?>
</body>
</html>
