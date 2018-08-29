<?php
// GET送信されたらデータベースに接続してスタジオ情報を取得する
 require('dbconnect');


if(isset($_GET[])) {
  if($_GET['number_of_users'] && $_GET['price'] && $_GET['area']){ // もし全部入力されていたら
      $sql = 'SELECT * FROM `studios` WHERE `number_of_users` = ?, `price` = ?, `area` = ?';
      $data = 
  } else if($_GET['number_of_users'] && $GET['price']){ // もし人数と値段だけ入力されていたら
      $sql = 'SELECT '
  }
}

// もし人数とエリアだけ入力されていたら
// もし値段とエリアだけ入力されていたら
// もし人数だけ入力されていたら
// もし値段だけ入力されていたら
// もしエリアだけ入力されていたら
// それ以外の場合（何も入力されていなかったら）


// 本文中の分はrowに対して３つのカードを表示する（カードが３件表示されるたびに新たなrowを挿入する）

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
    <div class="card-deck">
      <a href="detail.php" class="card result-a">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </a>
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>

    </div>
      <div class="card-deck">
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      
    </div>
    <div class="card-deck">
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="img/IMG_2105.jpg">
        <div class="card-body">
          <h5 class="card-title">〇〇スタジオ Aスタジオ</h5>
          <p class="card-text">テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト テキスト </p>
        </div>
        <div class="card-footer">
          <small class="text-muted">このスタジオの詳細を見る</small>
        </div>
      </div>
      
    </div>
  </section>


   <?php
    include('footer.php');
   ?>
</body>
</html>