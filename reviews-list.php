<?php
session_start();
require('dbconnect.php');


if(isset($_GET['from']) && $_GET['from'] == 'login') {
    $room_id = $_SESSION['rm'];
    $studio_id = $_SESSION['std'];
} else {
    $room_id = (int)$_GET['rm'];
    $studio_id = (int)$_GET['std'];
}

$reviews = [];
$sql = 'SELECT * FROM `reviews` WHERE `room_id` = ? AND `studio_id` = ? ORDER BY `created` DESC';
$data = [$room_id, $studio_id];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
        break;
    }
    $reviews[] = $rec;
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
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ー口コミ一覧ー
          </h1>
        </div>
      </div>
      <?php if(isset($_SESSION['id'])): ?>
        <?php foreach($reviews as $review): ?>
          <div class="row review-list">
            <div class="col-md-2">
              <img src="img/human.png">
            </div>
            <div class="col-md-10 relative">
              <p><?= $review['content']; ?></p>
              <p class="created-time"><?= $review['created']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
        <div class="centered">
          <?php if(empty($reviews)): ?>
              <p>まだこのスタジオの口コミはありません</p>
          <?php endif; ?>
          <a href="detail.php?std=<?= $studio_id ?>&rm=<?= $room_id ?>">
            <button class="btn btn-secondary btn-lg">戻る</button>
          </a>
          <a href="review-post.php?std=<?= $studio_id; ?>&rm=<?= $room_id; ?>">
            <button class="btn btn-info btn-lg">口コミを投稿する</button>
          </a>
        </div>
      <?php else: ?>
        <div class="centered to-login">
          <p>ログインすると口コミを見ることができます</p>
          <a href="signin.php"><button class="btn btn-info btn-lg">ログインする</button></a>
          <a href="signup.php"><button class="btn btn-info btn-lg">新規登録する</button></a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>


  <?php require('footer.php'); ?>

</body>
</html>