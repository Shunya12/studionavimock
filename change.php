<?php
session_start();
require('dbconnect.php');
$user_id = $_SESSION['id'];
$errors = [];

if(!isset($_SESSION['id'])) {
    header('Location: top.php');
    exit();
}

// ユーザー情報の取得
$sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
$data = [$user_id];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);


if(!empty($_POST)) {
// 名前とメールは送信時に再代入して、inputのバリューが元に戻るのを防ぐ
  $name = $_POST['name'];
  $user_info['name'] = $name;
  $email = $_POST['email'];
  $user_info['user_mail'] = $email;

// 空チェック
  if($name == '') {
      $errors['name'] = 'blank';
  }
  if($email == '') {
      $errors['email'] = 'blank';
  }

  if(empty($errors)) {
      $sql = 'UPDATE `users` SET `name` = ?, `user_mail` = ? WHERE `user_id` = ?';
      $data = [$name, $email, $user_id];
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);

      header('Location: mypage.php?from=changed');
      exit();
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
  <?php require('header.php'); ?>

<div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ー登録情報を変更するー
          </h1>
          <p>
            変更したい項目を書き換えてください
          </p>
        </div>
      </div>
        <form action="change.php" method="POST">
          <div class="form-group">
            <label>名前</label>
            <input type="text" name="name" class="form-control" value="<?= $user_info['name']; ?>">
            <?php if(isset($errors['name']) && $errors['name'] == 'blank'): ?>
              <p class="error_message">名前が入力されてません</p>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" class="form-control" value="<?= $user_info['user_mail']; ?>">
            <?php if(isset($errors['email']) && $errors['email'] == 'blank'): ?>
              <p class="error_message">メールアドレスが入力されていません</p>
            <?php endif; ?>
            <small class="form-text text-muted">予約時の確認メールの送信先となります。間違えないようにお気をつけください。</small>
          </div>
          <div>
            <a href="pw-change.php" class="body-link">- パスワードを変更する場合はこちら -</a>
          </div>
          <div class="submit-center">
            <input type="submit" name="" value="変更を保存する" class="btn btn-lg submit-color">
          </div>
        </form>
    </div>
  </div>
</div>

  <?php require('footer.php'); ?>

</body>
</html>