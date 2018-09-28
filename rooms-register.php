<?php
require('dbconnect.php');
$errors = [];


// エリア情報の取得
$areas = [];
$get_area_sql = 'SELECT * FROM `areas`';
$get_area_stmt = $dbh->prepare($get_area_sql);
$get_area_stmt->execute();
while (true) {
    $rec = $get_area_stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false) {
      break;
    }
    $areas[] = $rec;
}



if(!empty($_POST)) {
    $regist_sql = 'INSERT INTO `studios` 
    (`studio_name`, `studio_tel`, `studio_mail`,`reserve_type`, `url`, `station`, `address`, `area_id`, `lat`, `lng`, `created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())';

    $regist_data = [$_POST['studio_name'], $_POST['studio_tel'], $_POST['studio_mail'], $_POST['reserve_type'], $_POST['url'], $_POST['station'], $_POST['address'], $_POST['area_id'], $_POST['lat'], $_POST['lng']];
    $regist_stmt = $dbh->prepare($regist_sql);
    $regist_stmt->execute($regist_data);


    $registed_id = $dbh->lastInsertId();
    $number_of_rooms = $_POST['number_of_rooms'];

    header('Location: rooms-register.php?std=' . $registed_id . 'rms=' . $number_of_rooms);
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

<div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ー会員登録ー
          </h1>
          <p>
            会員登録でスタジオ予約をもっとスムーズに
          </p>
        </div>
      </div>
        <form method="POST" action="studios-register.php">
          <div class="form-group">
            <label>スタジオ名</label>
            <input type="text" name="studio_name" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>電話番号</label>
            <input type="tel" name="studio_tel" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="studio_mail" class="form-control">
          </div>
          <div class="form-group">
            <label>予約型(tmn)</label>
            <select class="custom-select" id="inputGroupSelect01" name="reserve_type">
                <option value="tmn" selected>電話・メール・予約サイト</option>
                <option value="tm">電話・メール</option>
                <option value="tn">電話・予約サイト</option>
                <option value="mn">メール・予約サイト</option>
                <option value="t">電話のみ</option>
                <option value="m">メールのみ</option>
                <option value="n">予約サイトのみ</option>
              </select>
          </div>
          <div class="form-group">
            <label>URL</label>
            <input type="url" name="url" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>最寄駅</label>
            <input type="text" name="station" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>住所</label>
            <input type="text" name="address" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>エリア</label>
            <select class="custom-select" id="inputGroupSelect02" name="area_id">
                <?php for ($i = 0; $i < count($areas); $i++): ?>
                    <option value="<?= $areas[$i]['area_id'] ?>" <?= $areas[$i] == 1 ? 'selected' : '' ; ?>><?= $areas[$i]['area_name'] ?></option>
                <?php endfor; ?>
            </select>
          </div>
          <div class="form-group">
            <label>緯度</label>
            <input type="text" name="lat" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>経度</label>
            <input type="text" name="lng" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>部屋数</label>
            <input type="number" name="number_of_rooms" class="form-control" value="1">
          </div>
          <div class="submit-center">
            <input type="submit" name="" value="スタジオを登録する" class="btn btn-lg submit-color">
          </div>
        </form>
    </div>
  </div>
</div>

   <?php
    include('footer.php');
   ?>

</body>
</html>